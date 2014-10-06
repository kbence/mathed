<?php

class DbPatch
{
    public $id;
    public $name;
    public $content;

    public function DbPatch($filename)
    {
        $basename = basename($filename);

        if (preg_match('/^(?P<id>\d+)_(?P<name>\S+).sql$/', $basename, $matches)) {
            $this->id = (int)$matches['id'];
            $this->name = ucfirst(str_replace('_', ' ', $matches['name']));
            $this->content = file_get_contents($filename);
        } else
            throw new Exception("The filename $basename does not look like a DB patch!");
    }

    public function getStatements()
    {
        return explode(';', $this->content);
    }
}

class DbPatcher
{
    protected $params;

    /** @var mysqli */
    protected $conn;

    public function DbPatcher(stdClass $params)
    {
        $this->params = $params;
    }

    protected function connect()
    {
        if (!$this->conn) {
            $this->conn = mysqli_connect($this->params->host, $this->params->username,
                $this->params->password, $this->params->database);
        }
    }

    protected function createPatchTable()
    {
        $result = $this->conn->query("SHOW TABLES LIKE 'db_patch'");
        $object = $result->fetch_object();

        if (!$object) {
            $createResult = $this->conn->query(
                "CREATE TABLE db_patch(" .
                    "id INT NOT NULL, " .
                    "name VARCHAR(64) NOT NULL, " .
                    "patched_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP," .
                    "PRIMARY KEY(id)" .
                ")"
            );

            if (!$createResult)
                throw new Exception("Patch table creation failed! " . $this->conn->error);
        }

        $result->free_result();
    }

    public function patch()
    {
        $this->connect();
        $this->createPatchTable();


        foreach ($this->getPatches() as $patchFile) {
            $patch = new DbPatch($patchFile);

            if (!$this->isApplied($patch->id)) {
                $this->apply($patch);
            }
        }
    }

    protected function getPatches()
    {
        return glob(dirname(__FILE__) . '/patches/*.sql');
    }

    protected function isApplied($id)
    {
        $result = $this->conn->query("SELECT * FROM db_patch WHERE id = " . ((int)$id));

        $row = $result->fetch_object();
        $result->free_result();

        return !!$row;
    }

    protected function apply(DbPatch $patch) {
        try {
            foreach ($patch->getStatements() as $statement) {
                $this->execute($statement);
            }

            $this->setToApplied($patch);
        } catch (Exception $e) {
            throw new Exception("Failed to execute patch $patch->id ($patch->name)!\n" .
                $e->getMessage(), 0, $e);
        }
    }

    protected function execute($statement)
    {
        $result = $this->conn->query($statement);

        if (!$result)
            throw new Exception('Query failed: ' . $this->conn->error);

        if ($result instanceof mysqli_result)
            $result->free_result();
    }

    protected function setToApplied(DbPatch $patch)
    {
        $result = $this->conn->query(
            "INSERT INTO db_patch(id, name) VALUES(" .
            (int)$patch->id . ", " .
            '"' . $this->conn->real_escape_string($patch->name) . '"' .
            ")"
        );

        if (!$result)
            throw new Exception("Can't insert to db_patch!");
    }
}

$dbConfig = json_decode(file_get_contents(dirname(__FILE__) . '/../../config.json'));

$patcher = new DbPatcher($dbConfig->mysql);
$patcher->patch();



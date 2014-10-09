<?php

class Conversion
{
    protected function tempFileName($suffix = '')
    {
        return tempnam(sys_get_temp_dir(), 'mathed') . $suffix;
    }

    protected function saveContent($content, $suffix = '')
    {
        $tempFileName = $this->tempFileName($suffix);
        $parentDir = dirname($tempFileName);

        if (file_exists($parentDir)) {
            unlink($parentDir);
        }

        mkdir($parentDir, 0777, true);

        file_put_contents($tempFileName, $content);
        return $tempFileName;
    }

    protected function execute()
    {
        $args = func_get_args();

        $options = (isset($args[0]) && is_array($args[0])) ? array_shift($args) : array();
        $cwd = isset($options['cwd']) ? $options['cwd'] : null;
        $timeout =  isset($options['timeout']) ? $options['timeout'] : null;

        if (count($args) < 1) {
            throw new Exception("Unspecified command!");
        }

        $command = array_shift($args);
        $commandArray = array_merge(
            array(escapeshellcmd($command)),
            array_map('escapeshellarg', $args)
        );

        $descriptors = array(
            0 => array("pipe", "r"),
            1 => array("pipe", "w"),
            2 => array("pipe", "w"),
        );

        $commandString = implode(' ', $commandArray);
        $proc = proc_open($commandString, $descriptors, $pipes, $cwd);

        if ($proc) {
            $started = microtime(true);

            $stdout = '';
            $stderr = '';

            stream_set_blocking($pipes[1], false);
            stream_set_blocking($pipes[2], false);

            do {
                $procStatus = proc_get_status($proc);

                if ($timeout && (microtime(true) - $started) >= $timeout) {
                    proc_terminate($proc, 9);
                    $procStatus['signalled'] = true;
                    $procStatus['exitcode'] = 255;
                }

                $stdout .= $this->readBytesFrom($pipes[1]);
                $stderr .= $this->readBytesFrom($pipes[2]);

                usleep(1000);
            } while ($procStatus['running']);

            proc_close($proc);

            return array(
                'status' => 'OK',
                'exitcode' => $procStatus['exitcode'],
                'stdout' => $stdout,
                'stderr' => $stderr,
            );
        }

        return array(
            'status' => 'Error',
            'message' => 'Couldn\'t start process ' . $commandString
        );
    }

    private function readBytesFrom($pipe)
    {
        $bytes = '';

        while ($currentBytes = fread($pipe, 8192)) {
            $bytes .= $currentBytes;
        }

        return $bytes;
    }
}

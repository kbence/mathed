<?php

class FileUtil
{
    public function getContents($filename)
    {
        return file_get_contents($filename);
    }
}


<?php

class logger
{
    public function __construct($data,$project,$fileName, $path)
    {
        $this->data =  $data;
        $this->fileName = $fileName . '_' .  rand(10,1000) . '_' .date('Y-m-d');
        $this->project = $project;
        $this->path = $path;
    }

    public function save() {
        // Open the file in append mode
        $this->createFolder();
        $file = fopen($this->path.$this->project.'/'.$this->fileName, 'a');

        // Write the logs to the file, one per line
        fwrite($file, $this->data );

        // Close the file
        fclose($file);
    }

    private function createFolder()
    {
        // Check if the folder already exists
        if (!file_exists($this->path.$this->project)) {
            // Create the folder with 0755 permissions (readable and writable by owner, readable by others)
            if (!mkdir($this->path.$this->project, 0755, true)) {
                // If the folder could not be created, throw an exception
                throw new Exception('Failed to create folder: ' . $this->path.$this->project);
            }
        }
    }




}

(new logger('test','wiess','logFile', '../'))->save();
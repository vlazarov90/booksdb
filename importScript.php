<?php

require_once 'bootstrap.php';

const XML_FOLDER = 'xml';

class ReadXml
{
    /**
     * @param $path
     */
    public function importFiles($path)
    {
        $dir = new RecursiveDirectoryIterator($path);
        $iterator = new RecursiveIteratorIterator($dir);
        $regexIterator = new RegexIterator($iterator, '/^.+\.xml$/i', RecursiveRegexIterator::GET_MATCH); //match all xml files in directory
        foreach ($regexIterator as $file) {
            echo "Begin import of {$file[0]}" . PHP_EOL;
            $this->insertXml($file[0]);
        }
    }

    /**
     * @param $file
     */
    private function insertXml($file)
    {
        $reader = new XMLReader();
        $reader->open($file);

        $book = new \Models\Book();

        // move to the first <book /> node
        while ($reader->read() && $reader->name !== 'book') ;

        while ($reader->name == 'book') {
            $node = new SimpleXMLElement($reader->readOuterXML());

            if(isset($node->author) && isset($node->name)){
                $book->insert($node->name, $node->author);
                echo "{$node->name} from {$node->author} has been inserted successfully".PHP_EOL;
            }else{
                echo "Wrong node format";
            }

            $reader->next('book');
        }
    }
}

$xmlReader = new ReadXml();
$xmlReader->importFiles(XML_FOLDER);
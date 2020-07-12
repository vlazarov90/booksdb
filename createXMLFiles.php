<?php

class XMLGenerator
{
    const SEEDS_FOLDER = 'seed';
    const XML_FOLDER = 'xml';

    const RECORDS_PER_XML = 10;

    const KEY_AUTHOR = 1;
    const KEY_NAME = 0;

    /**
     * @var string
     */
    private $currentFolder;

    /**
     * XMLGenerator constructor.
     */
    public function __construct()
    {
        $this->currentFolder = dirname(__FILE__).DIRECTORY_SEPARATOR.self::XML_FOLDER;
    }

    /**
     * @param $filename
     * @throws Exception
     *
     * Read csv
     */
    public function process($filename)
    {
        $seedsFolder = dirname(__FILE__).DIRECTORY_SEPARATOR.self::SEEDS_FOLDER;
        $file = $seedsFolder.DIRECTORY_SEPARATOR.$filename;

        if(!file_exists($file)){
            throw new Exception('File does not exist');
        }

        $source = fopen($file, 'r');

        $records = [];

        while ($data = fgetcsv($source, 300)){
            if(count($records) >= self::RECORDS_PER_XML){
                $this->createXml($records);
                $records = [];
            }else{
                $records[] = $data;
            }
        }
    }

    /**
     * @param array $data
     * @throws Exception
     */
    private function createXml($data = [])
    {
        $writer = new XMLWriter();

        $this->determinateXmlDir();

        if(!is_dir($this->currentFolder)){
            mkdir($this->currentFolder, 0777, true);
        }

        $writer->openUri($this->currentFolder.DIRECTORY_SEPARATOR.$this->generateRandomString().'.xml');
        $writer->startDocument("1.0");
        $writer->startElement("books");

        foreach ($data as $book){
            $writer->startElement("book");
            $writer->setIndent(true);
            $writer->startElement('author');
            $writer->text($book[self::KEY_AUTHOR]);
            $writer->endElement();
            $writer->startElement('name');
            $writer->text($book[self::KEY_NAME]);
            $writer->endElement();
            $writer->endElement();
        }

        $writer->endElement();
        $writer->endDocument();
        $writer->flush();
    }

    /**
     * Determinate in which folder xml should be saved
     */
    private function determinateXmlDir()
    {
        $resetFolder = mt_rand(0,10);

        // If rand is 0 reset to main xml folder
        if(!$resetFolder){
            $this->currentFolder = self::XML_FOLDER;
            return;
        }

        $createNewFolder = mt_rand(0,1);

        if($createNewFolder){
            $folderName = $this->generateRandomString();
            $this->currentFolder .= DIRECTORY_SEPARATOR.$folderName;
            return;
        }
    }

    /**
     * @return string
     * @throws Exception
     */
    private function generateRandomString()
    {
        $bytes = random_bytes(5);
        return bin2hex($bytes);
    }
}

$generator = new XMLGenerator();

$generator->process($argv['1']);
<?php


namespace Lib;


class View
{
    /**
     * @var string
     */
    private $title;

    /**
     * View constructor.
     */
    public function __construct()
    {
        $this->header = VIEWS_DIR.DIRECTORY_SEPARATOR."header.php";
        $this->footer = VIEWS_DIR.DIRECTORY_SEPARATOR."footer.php";
    }

    /**
     * @param $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Render template
     * @param $filename
     * @return string
     */
    public function render($filename)
    {
        $fullPath = VIEWS_DIR.DIRECTORY_SEPARATOR.$filename.".php";

        ob_start();

        require_once $this->header;
        require_once $fullPath;
        require_once $this->footer;

        return ob_get_clean();
    }
}
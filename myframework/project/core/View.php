<?php

namespace core;

class View
{
    public function render(Page $page)
    {
        return $this->renderLayout($page, $this->renderView($page));
    }
    private function renderLayout(Page $page, $content)
    {
        $layoutPath = $_SERVER['DOCUMENT_ROOT']."/project/layouts/{$page->layout}.php";

        ob_start();
        if(file_exists($layoutPath)){
            $title = $page->title;
            include $layoutPath;
            return ob_get_clean();
        }

    }
    private function renderView(Page $page)
    {
        $viewPath = $_SERVER['DOCUMENT_ROOT'] ."/project/views/{$page->view}.php";

        ob_strat();

        if(file_exists($viewPath)){
            $data = $page->data;
            extract($data);
            include $viewPath;
            return ob_get_clean();
        }

    }
}
<?php

namespace app\lib;

include_once 'app/models/ModelPosts.php';
class Paginationtest
{
    public $currentPage;
    public $perPage;
    public $total;
    public $countPages;
    public $uri;
    public $route;

    public function __construct($page, $perPage, $total)
    {
        $this->perPage = $perPage;
        $this->total = $total;
        $this->countPages = $this->getCountPages();
        $this->uri = $this->getParams();
        $this->route = $this->getRoute();
        $this->currentPage = $this->getCurrentPage($page);
    }

    public function __toString()
    {
        return $this->getHtml();
    }

    public function getHtml()
    {
        $back = null;
        $forward = null;
        $startpage = null;
        $endpage = null;
        $page2Left = null;
        $page1Left = null;
        $page2Right = null;
        $page1Right = null;

        //кнопка перехода на предыдующую страницу
        if ($this->currentPage > 1) {
            $back = "<li><a class='pagination-link' href='".$this->route ."/". ($this->currentPage - 1) . "'>&lt;</a></li>";
        }
        //кнопка перехода на следующую страницу
        if ($this->currentPage < $this->countPages) {
            $forward = "<li><a class='pagination-link' href='".$this->route ."/". ($this->currentPage + 1) . "'>&gt;</a></li>";
        }
        //кнопка перехода на первую страницу страницу
        if ($this->currentPage > 3) {
            $startpage = "<li><a class='pagination-link' href='".$this->route ."/1'>&laquo;</a></li>";
        }
        //кнопка перехода на последнюю страницу
        if ($this->currentPage < $this->countPages - 2) {
            $endpage = "<li><a class='pagination-link' href='".$this->route ."/". ($this->countPages) . "'>&raquo;</a></li>";
        }
        //кнопка перехода через одну предыдущую страницу с ее номером
        if ($this->currentPage - 2 > 0) {
            $page2Left = "<li><a class='pagination-link' href='".$this->route ."/". ($this->currentPage - 2) . "'>" . ($this->currentPage - 2) . '</a></li>';
        }
        //кнопка переходана предыдущую страницу с ее номером
        if ($this->currentPage - 1 > 0) {
            $page1Left = "<li><a class='pagination-link' href='".$this->route ."/". ($this->currentPage - 1) . "'>" . ($this->currentPage - 1) . '</a></li>';
        }
        if ($this->currentPage + 1 <= $this->countPages) {
            $page1Right = "<li><a class='pagination-link' href='".$this->route ."/". ($this->currentPage + 1) . "'>" . ($this->currentPage + 1) . '</a></li>';
        }
        if ($this->currentPage + 2 <= $this->countPages) {
            $page2Right = "<li><a class='pagination-link' href='".$this->route ."/". ($this->currentPage + 2) . "'>" . ($this->currentPage + 2) . '</a></li>';
        }

        return '<ul class="pagination-menu">' . $startpage . $back . $page2Left . $page1Left . '<li class="pagination-active"><a>' . $this->currentPage . '</a></li>' . $page1Right . $page2Right . $forward . $endpage . '</ul>';
    }

    public function getCountPages()
    {
        return ceil($this->total / $this->perPage) ?: 1;
    }

    public function getCurrentPage($page)
    {
        if (!$page || $page < 1) {
            $page = 1;
        }
        if ($page > $this->countPages) {
            $page = $this->countPages;
        }
        return $page;
    }

    public function getStart()
    {
        return ($this->currentPage - 1) * $this->perpage;
    }

    public function getParams()
    {
        $routes = explode('/', $_SERVER['REQUEST_URI']);
        $uri = $routes[3];
        return $uri;
    }
    public function getRoute()
    {
        $routes = explode('/', $_SERVER['REQUEST_URI']);
        unset($routes[3]);
        $route = implode('/', $routes);
        return $route;
    }
}

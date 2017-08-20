<?php

/**
 * Interface IFactory
 * 公共函数的工厂
 */
interface IFactory
{
    /**
     * 获取网站标题
     * @return mixed
     */
    public function get_web_title();

    /**
     * 设置网站标题
     * @param $title 标题
     * @return mixed
     */
    public function set_web_title($title);

    /**
     * 获取网站链接
     * @return mixed
     */
    public function get_web_link();

    /**
     * 设置网站链接
     * @param $link 链接
     * @return mixed
     */
    public function set_web_link($link);

    /**
     * 设置网站简介
     * @param $intro
     * @return mixed
     */
    public function set_web_intro($intro);

    /**
     * 获取网站简介
     * @return mixed
     */
    public function get_web_intro();


    /**
     * 获取管理员名
     * @return mixed
     */
    public function get_admin_name();

    /**
     * 设置管理员
     * @param $name
     * @param $password
     * @return mixed
     */
    public function set_admin($name, $newPassword, $oldPassword);

    /**
     * 获取logo
     * @return mixed
     */
    public function get_logo_src();

    /**
     * 设置logo
     * @param $src logo 链接
     * @return mixed
     */
    public function set_logo_src($src);

    /**
     * 网站favicon
     * @return mixed
     */
    public function get_favicon_src();


    /**
     * 网站favicon
     * @return mixed
     */
    public function set_favicon_src($src);

    /**
     * 获取导航
     * @return mixed
     */
    public function get_nav_list();

    /**
     * 添加导航
     * @param $name
     * @param $type
     * @param $value
     * @return mixed
     */
    public function set_navigation($name, $type, $value, $sort);

    /**
     * 删除导航
     * @param $navigation_id
     * @return mixed
     */
    public function delete_nav_list($navigation_id);

    /**
     * 分局id获取导航
     * @param $navigation_id
     * @return mixed
     */
    public function get_navigation_by_id($navigation_id);

    /**
     * 获取展示图
     * @return mixed
     */
    public function get_show_image();

    /**
     * 删除展示图
     * @param $id
     * @return mixed
     */
    public function delete_image_by_id($id);

    /**
     * 添加展示图
     * @param $src
     * @return mixed
     */
    public function add_image($src);

    /**
     * 添加分类
     * @param $category
     * @return mixed
     */
    public function set_category($category);

    /**
     * 获取分类列表
     * @return mixed
     */
    public function get_category_list();

    /**
     * 根据分类id获取分类
     * @param $category_id
     * @return mixed
     */
    public function get_category_by_id($category_id);

    /**
     * 根据id修改分类
     * @param $id 分类id
     * @param $name 分类名称
     * @return mixed
     */
    public function update_category_by_id($id, $name);

    /**
     * 根据id删除分类
     * @param $id
     * @return mixed
     */
    public function delete_category_by_id($id);

    /**
     * 获取关键词列表
     * @return mixed
     */
    public function get_keyword_list();

    /**
     * 添加关键词
     * @param $keyword
     * @return mixed
     */
    public function set_keyword($keyword);


    /**
     * 根据分类id获取关键词
     * @param $category_id
     * @return mixed
     */
    public function get_keyword_by_id($keyword_id);

    /**
     * 根据id修改关键词
     * @param $id 分类id
     * @param $name 分类名称
     * @return mixed
     */
    public function update_keyword_by_id($id, $name);

    /**
     * 根据id删除关键词
     * @param $id
     * @return mixed
     */
    public function delete_keyword_by_id($id);

    /**
     * @param $title
     * @param $intro
     * @param $article
     * @param $category
     * @param $keyword
     * @param $feature
     * @return mixed
     */
    public function add_article($title, $intro, $article, $category, $keyword, $feature);

    /**
     * 根据第几页，每页条数，分类，关键词 分页
     * @param $page
     * @param $count
     * @param $category
     * @param $category
     * @param $keyword
     * @return mixed
     */
    public function get_article_pages($page, $count, $category, $keyword);

    /**
     * 获取所有文章
     * @return mixed
     */
    public function get_all_article_list();

    /**
     * 根据id删除文章
     * @param $aid
     * @return mixed
     */
    public function delete_article_by_id($aid);

    /**
     * 根据id获取文章
     * @param $aid
     * @return mixed
     */
    public function get_article_by_id($aid);

    /**
     * 登录
     * @param $type
     * @param $uid
     * @param $pwd
     * @return mixed
     */
    public function login($uid, $pwd);
}
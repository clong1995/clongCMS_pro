<?php
/**
 * 公共函数的工厂的实现，此类不得被继承
 */
include 'Conn.class.php';
include 'IFactory.class.php';

final Class FactoryImpl extends Conn implements IFactory
{
    /**
     * 获取网站标题
     * @return mixed
     */
    public function get_web_title()
    {
        $sql = 'SELECT name FROM web_info WHERE id = "title" LIMIT 1';
        $rs = parent::query_stmt($sql, []);
        return $rs[0]['name'];
    }

    /**
     * 设置网站标题
     * @param 标题 $title
     */
    public function set_web_title($title)
    {
        $sql = 'REPLACE INTO web_info (id, name) VALUES ("title",?)';
        $paramArr = array(
            's',
            $title
        );
        return parent::update_stmt($sql, $paramArr);
    }

    /**
     * 获取网站链接
     * @return mixed
     */
    public function get_web_link()
    {
        $sql = 'SELECT name FROM web_info WHERE id = "link" LIMIT 1';
        $rs = parent::query_stmt($sql, []);
        return $rs[0]['name'];
    }

    /**
     * 设置网站链接
     * @param 链接 $link
     */
    public function set_web_link($link)
    {
        $sql = 'REPLACE INTO web_info (id, name) VALUES ("link",?)';
        $paramArr = array(
            's',
            $link
        );
        return parent::update_stmt($sql, $paramArr);
    }


    /**
     * 移动端网址
     */
    public function get_mobile_link(){
        $sql = 'SELECT name FROM web_info WHERE id = "mobile_link" LIMIT 1';
        $rs = parent::query_stmt($sql, []);
        return $rs[0]['name'];
    }

    /**
     * 移动端网址
     */
    public function set_mobile_link($mobilelink){
        $sql = 'REPLACE INTO web_info (id, name) VALUES ("mobile_link",?)';
        $paramArr = array(
            's',
            $mobilelink
        );
        return parent::update_stmt($sql, $paramArr);
    }



    /**
     * @param $intro
     * @return string
     */
    public function set_web_intro($intro)
    {
        $sql = 'REPLACE INTO web_info (id, name) VALUES ("intro",?)';
        $paramArr = array(
            's',
            $intro
        );
        return parent::update_stmt($sql, $paramArr);
    }


    /**
     * 获取网站简介
     * @return mixed
     */
    public function get_web_intro(){
        $sql = 'SELECT name FROM web_info WHERE id = "intro" LIMIT 1';
        $rs = parent::query_stmt($sql, []);
        return $rs[0]['name'];
    }

    /**
     * 获取管理员名
     * @return mixed
     */
    public function get_admin_name(){
        $sql = 'SELECT name FROM admin WHERE id = 1 LIMIT 1';
        $rs = parent::query_stmt($sql, []);
        return $rs[0]['name'];
    }

    /**
     * 设置管理员
     * @param $name
     * @param $password
     * @return string
     */
    public function set_admin($name,$newPassword,$oldPassword){
        //查询原始密码
        $sql = 'SELECT id FROM admin WHERE name = ? AND password = ?';
        $paramArr = array(
            'ss',
            $name,
            $oldPassword
        );
        $rs = parent::query_stmt($sql, $paramArr);
        if($rs[0]['id'] == 1){
            $sql = 'UPDATE admin SET name =?,password=? WHERE id = 1';
            $paramArr = array(
                'ss',
                $name,
                $newPassword
            );
            $rs = parent::update_stmt($sql, $paramArr);
        }else{
            $rs = 'failure';
        }
        return $rs;
    }

    /**
     * 获取网站logo
     * @return string
     */
    public function get_logo_src()
    {
        $sql = 'SELECT name FROM web_info WHERE id = "logo" LIMIT 1';
        $rs = parent::query_stmt($sql, []);
        return $rs[0]['name'];
    }

    /**
     * 设置网站logo
     * @param logo $src
     */
    public function set_logo_src($src)
    {
        $sql = 'REPLACE INTO web_info (id, name) VALUES ("logo",?)';
        $paramArr = array(
            's',
            $src
        );
        return parent::update_stmt($sql, $paramArr);
    }


    /**
     * 获取导航
     * @return array
     */
    public function get_nav_list()
    {
        $sql = 'SELECT id,name,type,target_id,target_name,sort FROM view_navigation ORDER BY sort';
        return parent:: query_stmt($sql, []);
    }

    /**
     * 添加导航
     * @param $name
     * @param $type
     * @param $value
     */
    public function set_navigation($name, $type, $value,$sort)
    {
        $sql = 'INSERT INTO navigation (name,type,sort,';

        if ($type == 1) {
            $sql .= 'category_id';
        } else if ($type == 2) {
            $sql .= 'article_id';
        } else {
            $sql .= 'link';
        }
        $sql .= ') VALUES (?,?,?,?)';
        $paramArr = array(
            'siis',
            $name,
            $type,
            $sort,
            $value
        );
        return parent::update_stmt($sql, $paramArr);
    }

    /**
     * 根据id获取导航
     * @param $navigation_id
     */
    public function get_navigation_by_id($navigation_id){
        $sql = 'SELECT name,type,target_id,target_name,sort FROM view_navigation WHERE id = ?';
        $paramArr = array(
            'i',
            $navigation_id
        );
        return parent::query_stmt($sql, $paramArr);
    }

    /**
     * 删除导航
     * @param $navigation_id
     * @return mixed
     */
    public function delete_nav_list($navigation_id)
    {
        $sql = 'DELETE FROM navigation WHERE id = ?';
        $paramArr = array(
            'i',
            $navigation_id
        );
        return parent::update_stmt($sql, $paramArr);
    }


    /**
     * 获取展示图
     * @return array
     */
    public function get_show_image()
    {
        $sql = 'SELECT id,src FROM show_image';
        return parent:: query_stmt($sql, []);
    }

    /**
     * 删除展示图
     * @param $id
     */
    public function delete_image_by_id($id)
    {
        $sql = 'DELETE FROM show_image WHERE id = ?';
        $paramArr = array(
            'i',
            $id
        );
        return parent::update_stmt($sql, $paramArr);
    }

    /**
     * 添加展示图
     * @param $src
     * @return mixed
     */
    public function add_image($src)
    {
        //插入特色图
        $srcArr = explode(',', $src);
        $srcValues = '';
        $srcTypes = '';
        $paramArr = array('types');
        foreach ($srcArr as $value) {
            $srcValues .= '(?),';
            $srcTypes .= 's';
            $paramArr[] = $value;
        }
        $srcValues = rtrim($srcValues, ",");
        $paramArr[0] = $srcTypes;
        $sql = 'INSERT INTO show_image (src) VALUES ' . $srcValues;

        return parent::update_stmt($sql, $paramArr);
    }


    /**
     * 设置分类
     * @param $category
     */
    public function set_category($categoryName)
    {
        $sql = 'INSERT INTO category (name) VALUES (?)';
        $paramArr = array(
            's',
            $categoryName
        );
        return parent::update_stmt($sql, $paramArr);
    }

    /**
     * 获取分类列表
     * @return mixed
     */
    public function get_category_list()
    {
        $sql = 'SELECT id,name,article_count FROM view_category';
        return parent::query_stmt($sql, []);
    }

    /**
     * 根据分类id获取分类
     * @param $category_id
     * @return mixed
     */
    public function get_category_by_id($category_id)
    {
        $sql = 'SELECT name FROM category WHERE id = ?';
        $paramArr = array(
            'i',
            $category_id
        );
        return parent::query_stmt($sql, $paramArr);
    }

    /**
     * 根据分类id修改分类
     * @param 分类id $id
     * @param 分类名称 $name
     * @return string
     */
    public function update_category_by_id($id, $name)
    {
        $sql = 'UPDATE category SET name = ? WHERE id = ?';
        $paramArr = array(
            'si',
            $name,
            $id

        );
        return parent::update_stmt($sql, $paramArr);
    }

    /**
     * @param $id
     */
    public function delete_category_by_id($id)
    {
        $sql = 'DELETE FROM category WHERE id = ?';
        $paramArr = array(
            'i',
            $id
        );
        return parent::update_stmt($sql, $paramArr);
    }


    /**
     * 获取关键词列表
     * @return mixed
     */
    public function get_keyword_list()
    {
        $sql = 'SELECT id,name,article_count FROM view_keyword';
        return parent::query_stmt($sql, []);
    }

    /**
     * 添加关键词
     * @param $keyword
     * @return mixed
     */
    public function set_keyword($keyword)
    {
        $sql = 'INSERT INTO keyword (name) VALUES (?)';
        $paramArr = array(
            's',
            $keyword
        );
        return parent::update_stmt($sql, $paramArr);
    }


    /**
     * 根据分类id获取关键词
     * @param $category_id
     * @return mixed
     */
    public function get_keyword_by_id($keyword_id)
    {
        $sql = 'SELECT name FROM keyword WHERE id = ?';
        $paramArr = array(
            'i',
            $keyword_id
        );
        return parent::query_stmt($sql, $paramArr);
    }

    /**
     * 根据分类id修改关键词
     * @param 分类id $id
     * @param 分类名称 $name
     * @return string
     */
    public function update_keyword_by_id($id, $name)
    {
        $sql = 'UPDATE keyword SET name = ? WHERE id = ?';
        $paramArr = array(
            'si',
            $name,
            $id

        );
        return parent::update_stmt($sql, $paramArr);
    }

    /**
     * @param $id
     */
    public function delete_keyword_by_id($id)
    {
        $sql = 'DELETE FROM keyword WHERE id = ?';
        $paramArr = array(
            'i',
            $id
        );
        return parent::update_stmt($sql, $paramArr);
    }

    /**
     * @param $title
     * @param $intro
     * @param $article
     * @param $category
     * @param $keyword
     * @param $feature
     */
    public function add_article($title, $intro, $article, $category, $keyword, $feature)
    {

        $aid = time() . getRandomChar(4);

        //插入文章表
        $author = 1;
        $articleSql = 'INSERT INTO article (id,title,intro,article,admin_id) VALUES(?,?,?,?,?)';
        $articleParamArr = array(
            'ssssi',
            $aid,
            $title,
            $intro,
            $article,
            $author
        );

        //插入分类
        $categoryArr = explode(',', $category);
        $categoryValues = '';
        $categoryTypes = '';
        $categoryParamArr = array('types');
        foreach ($categoryArr as $value) {
            $categoryValues .= '(?,?),';
            $categoryTypes .= 'si';
            $categoryParamArr[] = $aid;
            $categoryParamArr[] = $value;
        }
        $categoryValues = rtrim($categoryValues, ",");
        $categoryParamArr[0] = $categoryTypes;
        $categorySql = 'INSERT INTO article_rule_category (article_id, category_id) VALUES ' . $categoryValues;


        //插入关键词
        $keywordArr = explode(',', $keyword);
        $keywordValues = '';
        $keywordTypes = '';
        $keywordParamArr = array('types');
        foreach ($keywordArr as $value) {
            $keywordValues .= '(?,?),';
            $keywordTypes .= 'si';
            $keywordParamArr[] = $aid;
            $keywordParamArr[] = $value;
        }
        $keywordValues = rtrim($keywordValues, ",");
        $keywordParamArr[0] = $keywordTypes;
        $keywordSql = 'INSERT INTO article_rule_keyword (article_id, keyword_id) VALUES ' . $keywordValues;

        //插入特色图
        $featureArr = explode(',', $feature);
        $featureValues = '';
        $featureTypes = '';
        $featureParamArr = array('types');
        foreach ($featureArr as $value) {
            $featureValues .= '(?,?),';
            $featureTypes .= 'ss';
            $featureParamArr[] = $value;
            $featureParamArr[] = $aid;
        }
        $featureValues = rtrim($featureValues, ",");
        $featureParamArr[0] = $featureTypes;
        $featureSql = 'INSERT INTO feature_img (src, article_id) VALUES ' . $featureValues;


        //事务数组
        $txSqlStmtArr = array(
            array($articleSql, $articleParamArr),
            array($categorySql, $categoryParamArr),
            array($keywordSql, $keywordParamArr),
            array($featureSql, $featureParamArr)
        );


        return parent::update_stmt_tx($txSqlStmtArr);
    }

    /**
     * 根据第几页，每页条数，分类，关键词 分页
     * @param $page
     * @param $count
     * @param $category
     * @param $category
     * @param $keyword
     * @return mixed
     */
    public function get_article_pages($page, $count, $category, $keyword)
    {
        $allCount = 0;

        $countSql = '';

        $dataFieldList = 'va.id, va.title, va.intro, va.article,va.feature_img, va.time, va.admin_name, va.category_id, va.category_name, va.keyword_id, va.keyword_name, va.visit_count, va.comment_count';
        $dataOrderBy = 'ORDER BY time DESC';
        $dataLimit = 'LIMIT ?,?';
        $dataSql = '';
        $start = ($page - 1) * $count;

        $countParamArr = array();
        $dataParamArr = array();


        if (!empty($category) && empty($keyword)) {

            //count
            $countSql = 'SELECT COUNT(*) AS count FROM article_rule_category WHERE category_id = ?';
            $countParamArr = array('i', $category);

            //data
            $dataSql = 'SELECT ' . $dataFieldList . ' FROM article_rule_category ac LEFT JOIN view_article va ON ac.article_id = va.id WHERE ac.category_id = ? '. $dataOrderBy . ' ' . $dataLimit;
            $dataParamArr = array('iii', $category, $start, $count);


        } else if (!empty($keyword) && empty($category)) {

            //count
            $countSql = 'SELECT COUNT(*) AS count FROM article_rule_keyword WHERE keyword_id = ?';
            $countParamArr = array('i', $keyword);

            //data
            $dataSql = 'SELECT ' . $dataFieldList . ' FROM article_rule_keyword ak LEFT JOIN view_article va ON ak.article_id = va.id WHERE ak.keyword_id = ? '. $dataOrderBy . ' ' . $dataLimit;
            $dataParamArr = array('iii', $keyword, $start, $count);

        } else if (!empty($category) && !empty($keyword)) {

            //count
            $countSql = 'SELECT count(*) AS count FROM article_rule_category ac LEFT JOIN article_rule_keyword ak ON ac.article_id = ak.article_id WHERE category_id = ? AND keyword_id = ?';
            $countParamArr = array('ii', $category, $keyword);

            //data
            $dataSql = 'SELECT ' . $dataFieldList . ' FROM article_rule_category ac LEFT JOIN article_rule_keyword ak ON ac.article_id = ak.article_id LEFT JOIN view_article va ON ac.article_id = va.id WHERE ac.category_id = ? AND ak.keyword_id = ? '. $dataOrderBy . ' ' . $dataLimit;
            $dataParamArr = array('iiii', $category, $keyword, $start, $count);

        } else {

            //count
            $countSql = 'SELECT count(*) AS count FROM article';

            //data
            $dataSql = 'SELECT ' . $dataFieldList . ' FROM view_article va ' . $dataOrderBy . ' ' . $dataLimit;
            $dataParamArr = array('ii', $start, $count);
        }

        //info
        $allCount = parent::query_stmt($countSql, $countParamArr);
        $allPage = ceil($allCount[0]['count'] / $count);
        $info = array(
            'page' => $page,
            'allPage' => $allPage
        );

        //data
        $data = parent::query_stmt($dataSql, $dataParamArr);

        return array('info' => $info, 'data' => $data);
    }


    /**
     * 获取所有文章
     * @return mixed
     */
    public function get_all_article_list()
    {
        $sql = 'SELECT id,title FROM article';
        $paramArr = array();
        return parent::query_stmt($sql, $paramArr);
    }

    /**
     * 根据id删除文章
     * @param $aid
     * @return mixed
     */
    public function delete_article_by_id($aid)
    {
        $sql = 'DELETE FROM article WHERE id = ?';
        $paramArr = array(
            's',
            $aid
        );
        return parent::update_stmt($sql, $paramArr);
    }

    /**
     * 根据id获取文章
     * @param $aid
     * @return mixed
     */
    public function get_article_by_id($aid)
    {
        $sql = 'SELECT id, title, feature_img,intro,article, time, admin_name, category_id, category_name, keyword_id, keyword_name, visit_count, comment_count FROM view_article WHERE id = ?';
        $paramArr = array(
            's',
            $aid
        );
        return parent::query_stmt($sql, $paramArr);
    }

    /**
     * @param $type
     * @param $uid
     * @param $pwd
     */
    public function login($uid,$pwd){
        $sql = 'SELECT time FROM admin WHERE name = ? AND password = ?';
        $paramArr = array('ss',$uid,$pwd);
        return parent::query_stmt($sql, $paramArr);
    }

    /**
     * 网站favicon
     * @return mixed
     */
    public function get_favicon_src(){
        $sql = 'SELECT name FROM web_info WHERE id = "favicon" LIMIT 1';
        $rs = parent::query_stmt($sql, []);
        return $rs[0]['name'];
    }


    /**
     * 网站favicon
     * @return mixed
     */
    public function set_favicon_src($src){
        $sql = 'REPLACE INTO web_info (id, name) VALUES ("favicon",?)';
        $paramArr = array(
            's',
            $src
        );
        return parent::update_stmt($sql, $paramArr);
    }


}
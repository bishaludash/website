<?php

namespace App\Logic\FE;

use App\Traits\DBUtils;

class BlogFeLogic{

    use DBUtils;

    public function getFeaturedPost()
    {
        $featured_query = "select p.id,p.post_title, 
        p.category_id, p.post_body, im.image_path
        from posts p left join image_managers im on p.id=im.foreign_id
        where p.is_featured='t' and p.archive='f' order by p.created_at desc limit 1 ";

        $res = $this->selectFirstQuery($featured_query);
        return $res;
    }


    public function getPinnedPost()
    {
        $pinned_query = "select p.id, p.post_title, p.updated_at, p.category_id,p.updated_at, c.cat_name
        from posts p inner join categories c on p.category_id=c.id 
        where p.is_pinned='t' order by p.created_at desc limit 2
        ";

        $res = $this->selectQuery($pinned_query);
        return $res;
    }

    public function getLatestPost()
    {
        $query = "select p.id, p.post_title, left(p.post_body, 200) as post_body,p.created_at,p.image_path, 
        concat(u.fname,' ', u.lname) as username, c.cat_name from posts p 
        inner join users u on u.id=p.user_id 
        inner join categories c on c.id= p.category_id
        where archive='f'  
        order by p.created_at desc limit 8";

        $res = $this->selectQuery($query);
        return $res;
    }

    public function getArchivedPost(){
        $archive_query = "select date_part('year', created_at) as year,
        date_part('month', created_at)as month, 
        count(*) published from posts 
        group by year, month order by min(created_at) desc";
        
        $res = $this->selectQuery($archive_query);
        return $res;
    }


}
<?php
class rprhag {
    public static function getAuthorLink() {
        $authorName = get_the_author_meta('display_name');
        
        if (self::checkAuthorHasPage($authorName)) {
            $authorPermalink = self::getAuthorPermalink($authorName);
            
            return '<a href="'.$authorPermalink.'" rel="author" itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name">'.$authorName.'</span></a>';
        } else {
            $authorEmail = get_the_author_meta('user_email');
            
            if( $authorEmail != "") {
                return '<a href="mailto:'.$authorEmail.'" itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name">'.$authorName.'</span></a>';
            }else{
                return '<span itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name">'.$authorName.'</span></span>';
            }
        }
    }
    
    
    private static function getAuthorPermalink($authorName){
        $authorPermalink = strtolower(str_replace(' ', '-', $authorName));
        
        return '/authors/' . $authorPermalink;
    }
    
    private static function checkAuthorHasPage($authorName){
        $page = get_page_by_title($authorName, 'OBJECT', 'page');
        if( !is_null($page) )  {
            $parents = get_ancestors($page->ID, 'page');
            if(count($parents) > 0) {
                $page = get_post($parents[0], 'OBJECT');
                return (strtolower($page->post_title) == 'authors');
            }
        }
        
        return false;
    }
}
?>
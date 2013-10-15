<?php
class rprhag {
    public static function getCreatedModifiedHtml() {
        $created = get_the_date('jS M Y');
        $modified = get_the_modified_date('jS M Y');
        
        $html = '<span class="created-date"><strong>Created:</strong> <time datetime="'.get_the_date('Y-m-d H:i').'" itemprop="dateCreated">'.$created.'</time></span>';
        if( $created != $modified) {
            $html .= ' (<span class="modified-date"><strong>Modified:</strong> <time datetime="'.get_the_modified_date('Y-m-d H:i').'" itemprop="dateModified">'.$modified.'</time></span>)';
        }
        
        return $html;
    }
    
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
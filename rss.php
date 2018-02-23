<?php
// Check http://www.systutorials.com/136102/a-php-function-for-fetching-rss-feed-and-outputing-feed-items-as-html/ for description
// RSS to HTML
/*
    $tiem_cnt: max number of feed items to be displayed
    $max_words: max number of words (not real words, HTML words)
    if <= 0: no limitation, if > 0 display at most $max_words words
 */
function get_rss_feed_as_html($feed_url, $max_item_cnt = 10, $show_date = true, $show_description = true, $max_words = 0, $cache_timeout = 7200, $cache_prefix = "/tmp/rss2html-")
{
    $result = "";
    // get feeds and parse items
    $rss = new DOMDocument();
    $cache_file = $cache_prefix . md5($feed_url);
    // load from file or load content
    if ($cache_timeout > 0 &&
        is_file($cache_file) &&
        (filemtime($cache_file) + $cache_timeout > time())) {
            $rss->load($cache_file);
    } else {
        $rss->load($feed_url);
        if ($cache_timeout > 0) {
            $rss->save($cache_file);
        }
    }
    $feed = array();
    foreach ($rss->getElementsByTagName('item') as $node) {
        $item = array (
            'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
            'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
            'content' => $node->getElementsByTagName('description')->item(0)->nodeValue,
            'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
            'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
        );
        $content = $node->getElementsByTagName('encoded'); // <content:encoded>
        if ($content->length > 0) {
            $item['content'] = $content->item(0)->nodeValue;
        }
        array_push($feed, $item);
    }
    // real good count
    if ($max_item_cnt > count($feed)) {
        $max_item_cnt = count($feed);
    }

    for ($x=0;$x<$max_item_cnt;$x++) {
        $title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
        $link = $feed[$x]['link'];
        if ($show_date) {
            $date = date('l F d, Y', strtotime($feed[$x]['date']));
        }
        if ($show_description) {
            $description = $feed[$x]['desc'];
            $content = $feed[$x]['content'];
            // find the img
            $has_image = preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $content, $image);
            // no html tags
            $description = strip_tags(preg_replace('/(<(script|style)\b[^>]*>).*?(<\/\2>)/s', "$1$3", $description), '');
            // whether cut by number of words
            if ($max_words > 0) {
                $arr = explode(' ', $description);
                if ($max_words < count($arr)) {
                    $description = '';
                    $w_cnt = 0;
                    foreach($arr as $w) {
                        $description .= $w . ' ';
                        $w_cnt = $w_cnt + 1;
                        if ($w_cnt == $max_words) {
                            break;
                        }
                    }
                }
            }
            // add img if it exists
            if ($has_image == 1) {
                 $img = $image['src'];
            }
        }
    $result .= '<div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">';
   $result .= '<div class="mdl-card__media">';
   $result .= '<img src="'.$img.'">';
   $result .= '</div>';
   $result .= '<div class="mdl-card__title">';
   $result .= '<h4 class="mdl-card__title-text">'.$title.'</h4>';
   $result .= '</div>';
   $result .= '<div class="mdl-card__supporting-text">';
   $result .= '<span class="mdl-typography--font-light mdl-typography--subhead">'. $description .'...';
   $result .= '</div>';
   $result .= '<div class="mdl-card__actions">';
   $result .= '<a class="android-link mdl-button mdl-js-button mdl-typography--text-uppercase" href="'.$link.'">';
   $result .= 'Ver mas';
   $result .= '<i class="material-icons">chevron_right</i>';
   $result .= '</a></div></div>';
    }
    return $result;
}
function output_rss_feed($feed_url, $max_item_cnt = 10, $show_date = true, $show_description = true, $max_words = 0)
{
    echo get_rss_feed_as_html($feed_url, $max_item_cnt, $show_date, $show_description, $max_words);
}
?>

<?php
// output RSS feed to HTML
output_rss_feed('localhost/blog/feed/', 4, true, true, 200);
?>
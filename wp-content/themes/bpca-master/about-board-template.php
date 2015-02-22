<?php

/**
* Template Name: About - Board Template
* 
*/

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                <?php if(function_exists('bcn_display') && !is_home())
                {
                    bcn_display();
                }?>
            </div>
        <?php
            // what is the background and text color of the quotation box?
            switch (get_field('quote_bg')) {
                case 1:
                    // blue with white text
        ?>
        <div id="page-quote-blue">
        <?php
                    break;
                case 2:
                    // yellow with black text
        ?>
        <div id="page-quote-yellow">
        <?php
                    break;
            }
        ?>
            <div class="head-quote-text">
                &quot;<?=the_field('quote_box');?>&quot;
            </div>
            <div class="head-quote-attrib">
                <?=strtoupper(get_field('quote_attrib'));?><br />
                <?=get_field('quote_title');?>
            </div>
        </div>
            <div class="page-head-img">
                <?=the_post_thumbnail();?>
            </div>
            <?php
                // does the page have a diagram
                if (get_field('diagram_1') != "") {
                    
            ?>
            <div class="diagram">
                <img src="<?=the_field('diagram_1');?>" border="0" />
            </div>
            <?php
                }
                // count the number of words in the description text and split the text in half
                $page_data = get_page(get_the_ID());
                $fulldescrtext = apply_filters('the_content', $page_data->post_content);
                //echo $fulldescrtext;
                $totalwords = str_word_count($fulldescrtext);
                $halfwords = ceil($totalwords / 2);
                //echo $halfwords . "<br />";
                $descr1text = splitTextByWords($fulldescrtext, $halfwords);
                $descr2text = splitTextByWords($fulldescrtext, $halfwords, $halfwords);
            ?>
            
            <div class="section-title" 
                 <?php
                    // does the page have a diagram
                if (get_field('diagram_1') == "") {
                    echo 'id="notop" ';
                }
                ?>
                 >
                <?=strtoupper(get_field('section_title_1'));?>
            </div>
            <div class="page-descr-container"
                 <?php
                    // does the page have a diagram
                if (get_field('section_title_2') != "") {
                    echo 'id="nobottom" ';
                }
                ?>
                 >
                <div class="page-descr-box-1">
                    <div class="page-descr-text">
                        <?=$descr1text;?>
                    </div>
                </div>
                <div class="page-descr-box-2">
                    <div class="page-descr-text">
                        <?=$descr2text;?>
                    </div>
                </div>
            </div>
            <?php
                // does the page have a diagram
                if (get_field('section_title_2') != "") {
                    
            ?>
            <div class="section-title">
                <?=strtoupper(get_field('section_title_2'));?>
            </div>
            <?php
                }
                // does the page have a second diagram
                if (get_field('diagram_2') != "") {
                    
            ?>
            <div class="diagram">
                <img src="<?=the_field('diagram_2');?>" border="0" />
            </div>
        <?php
                }
            // which teaser box needs to be displayed?
            switch (get_field('teaser_box')) {
                case 1:
                   if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Teasers Set 1') ) : 
                    endif;
                   break;
                case 2:
                    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Teasers Set 2') ) : 
                    endif;
                   break;
                case 3:
                    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Teasers Set 3') ) : 
                    endif;
                   break;
            }
        ?>
    </main>
</div>
<?php
// function to split words from a large amount of text
function splitTextByWords($str, $words, $startat = 0)
{
    $arr = preg_split("/[\s]+/", $str, $words+1);
    $arr = array_slice($arr, $startat, $words);
    return join(' ', $arr);
}

get_footer(); ?>
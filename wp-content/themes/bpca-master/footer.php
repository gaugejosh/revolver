<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package bpca-master
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
            <div class="footer-area">
            <div class="footer-widget-area">
                <div class="footer-col-1">
                        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 1') ) : ?>
          <?php endif; ?>
                </div>
                <div class="footer-col-2">
                        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 2') ) : ?>
          <?php endif; ?>
                </div>
                <div class="footer-col-3">
                        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 3') ) : ?>
          <?php endif; ?>
                </div>
            </div>
            <div class="footer-logo-area">
                <img src="<?php echo get_template_directory_uri(); ?>/images/Battery Park Authority B&W.png" width="50" height="50" />
                <p class="copyright-area">COPYRIGHT <i class="fa fa-copyright"></i> 2015 / SITE CREATED BY <a href="http://revolverstudios.com">REVOLVER STUDIOS</a>
                </p>
            </div>
            </div>

	</footer><!-- #colophon -->
</div><!-- #page -->
<script type="text/javascript">
// function to force the parks link logo to revert back to its unhovered state
function revertImg() {
    console.log('fired');
    $('.img-swap').css({'background-position':'0 0'});
}
jQuery(document).ready(function(){
  /*
        jQuery('input').iCheck({
    checkboxClass: 'icheckbox_minimal',
    radioClass: 'iradio_minimal'
  });
        */

    $("li.menu-item").addClass('off');
    $(".sub-menu").hide();
    $(".current_page_item .sub-menu").show();
    $("li.menu-item.menu-item-type-custom").click(function (event) { // mouse CLICK instead of hover
        // Only prevent the click on the topmost buttons
        //if ($('.sub-menu', this).length >=1) {
            //event.preventDefault();
        //}
        $(".sub-menu").hide(); // First hide any open menu items
        $(this).find(".sub-menu").show(); // display child
        if ($("li.menu-item.menu-item-type-custom").hasClass('off')) {
            $("li.menu-item.menu-item-type-custom").removeClass('on'); // remove previous on link
            $(this).removeClass('off');
            $(this).addClass('on');
        }
        //event.stopPropagation();
        //$(this).off('mouselevea mounseover');
    });

    /*
    $("li.menu-item").mouseenter(function () {
        $(".sub-menu").hide(); // First hide any open menu items
        $(this).find(".sub-menu").show(); // display child
    });

    $("li.menu-item").mouseleave(function () {
        $(this).find(".sub-menu").show(); // display child
    });
    */
});
</script>
<script type="text/javascript">
//<![CDATA[
if (typeof newsletter_check !== "function") {
window.newsletter_check = function (f) {
    var re = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-]{1,})+\.)+([a-zA-Z0-9]{2,})+$/;
    if (!re.test(f.elements["ne"].value)) {
        alert("The email is not correct");
        return false;
    }
    if (f.elements["ny"] && !f.elements["ny"].checked) {
        alert("You must accept the privacy statement");
        return false;
    }
    return true;
}
}
//]]>
</script>
<script type="text/javascript">
    var tablet = window.matchMedia("(max-width: 768px)");
         var phone = window.matchMedia("(max-width: 414px)");
$( "#search-logo" ).click(function() {
    if ($(this).hasClass("closed")) {
        $(this).removeClass("closed");
        $(this).addClass("open");

        // only toggle the menu if on a desktop
        if (!phone.matches && !tablet.matches) {
            $("#site-navigation").animate({'padding-left': "-=140"}, {queue:false});
        }
        $("#site-search").animate({width:'toggle'},{queue:false});
    } else {
        $(this).removeClass("open");
        $(this).addClass("closed");
        $("#site-search").animate({width:'toggle'},{queue:false});
        if (!phone.matches && !tablet.matches) {
            $("#site-navigation").animate({'padding-left': "+=140"}, {queue:false});
        }
    }
}
);
</script>
<script type="text/javascript">
    $( 'a[href="#"]' ).click( function(e) {
      e.preventDefault();
   } );

    function sf_widget_constantcontact_2_submit(n){for(var a=n.querySelectorAll("input"),i=0,eml=false,val=["action=constantcontactadd"];i<a.length;i++)if(a[i].name){if(a[i].name=="req"){if(!a[i].checked){alert("Consent required");return false;}}else{if(!(a[i].name!="eml"||!a[i].value))eml=true;val.push(a[i].name+"="+encodeURIComponent(a[i].value));}}if(!eml){alert("Please enter an email address");return false;}var xml=new XMLHttpRequest();xml.open("POST","http://bpca.revolverbranding.com/wp-admin/admin-ajax.php",true);xml.setRequestHeader("Content-type","application/x-www-form-urlencoded");xml.onreadystatechange=function(){if(this.readyState==4){if(this.status==200){if(this.responseText)alert(this.responseText);else n.innerHTML="<input type=\"text\" name=\"eml\" class=\"input\" placeholder=\"ENTER EMAIL ADDRESS\"><input type=\"submit\" value=\"Submit\"><div class=\"yay\">Thank You For Subscribing!</div>";}else alert(this.statusText);}};xml.send(val.join(String.fromCharCode(38)));return false;}

    jQuery(document).ready(function ($) {

                // creating a container variable to hold the 'UL' element. It uses method chaining.
                var container=$('div.slider')
                                            .css('overflow','hidden')
                                            .children('ul');

                // creating pagination variable which holds the 'UL' element.
                var pagicontainer=$('div.pagi-container').children('ul');

                /*
                On the event of mouse-hover,
                    i) Change the visibility of Button Controls.
                    ii) SET/RESET the "intv" variable to switch between AutoSlider and Stop mode.
                */
                $('.gallery').hover(function( e ){
                    //$('.slider-nav').toggle();
                    return e.type=='mouseenter'?clearInterval(intv):autoSlider();
                });

                // Creating the 'slider' instance which will set initial parameters for the Slider.
                var sliderobj= new slider(container,pagicontainer,$('.slider-nav'));
                /*
                This will trigger the 'setCurrentPos' and 'transition' methods on click of any button
                 "data-dir" attribute associated with the button will determine the direction of sliding.
                */
                sliderobj.nav.find('button').on('click', function(){
                    sliderobj.setCurrentPos($(this).data('dir'));
                    sliderobj.transition();
                });

                /*
                This will trigger the 'setCurrentPos' and 'transition' methods on click of any Pagination icons.
                 "data-pgno" attribute associated with the Pagination icons will determine the value of current variable.
                */
                sliderobj.pagicontainer.find('li a').on('click', function(e){
                    e.preventDefault();
                    sliderobj.setCurrentPos($(this).data('pgno'));
                    sliderobj.transition();
                });

                autoSlider(); // Calling autoSlider() method on Page Load.

                /*
                This function will initialize the interval variable which will cause execution of the inner function after every 3 seconds automatically.
                */
                function autoSlider()
                {
                    return intv = setInterval(function(){
                        sliderobj.setCurrentPos('next');
                        sliderobj.transition();
                    }, 3000);
                }



            });
</script>
<script type="text/javascript">
    /*
This method will initialize each slider instance.
Parameter are: -
------------------
1) container -> div.slider ul
2) pagicontainer -> div.pagi-container ul
3) nav -> #slider-nav
*/
function slider(container, pagicontainer, nav){
    this.container=container;
    this.pagicontainer=pagicontainer;
    this.nav=nav.show(); // This will assign 'nav' from parameters to 'nav' of current slider instance. It uses method chaining.
    this.imgs=this.container.find('.slides'); // Returns jQuery object containing all matched elements.
    // Following commented line will not work here, as DIVs are Dynamic by nature unlike images where dimensions are known at "PageLoad( )" event.
    // this.width=this.imgs[0].width;
    var tablet = window.matchMedia("(max-width: 768px)");
    var phone = window.matchMedia("(max-width: 414px)");

    if (phone.matches) {
        this.width=300;
    } else if (tablet.matches) {
        this.width=320;
    } else {
        this.width=400;
    }
    //this.width=400; // Only add contents within this limit. Longer sentences will be continued on next Line.
    //console.log('Value of width is : '+this.width);
    this.imgLen=this.imgs.length; // Returns the total number of sliding elements.
    //console.log("Total no. of Items in the list are : "+this.imgLen);
    // Here we will fill the Pagination with the following list.
    out = "";
    cnt=0;
    this.liArr = $(container).find('li');// Returns jQuery object containing all matched LI elements.
    this.liArr.each(function()
    {
        out += "<li><a href='#' data-pgno='"+cnt+"'></a></li>"; // Here (CNT+1) is displayed on the WebPage, But the "pgno" attribute starts from ZERO only.
        cnt++;
    });

    this.pagicontainer.html(out); // Adding the List to the Pagination Container.
    this.current=0; // Initialize the "current" counter.
    // Apply CSS to "First" pagination element in the list.
    this.pagicontainer.find('li').find("[data-pgno='" + this.current + "']").css({
      //border : "2px solid grey",
      //fontWeight: "900",
      //fontSize:"18px"
      width: "14px",
      height: "14px",
      border: "1px solid",
      background: "#fff",
      borderRadius: "7px"
    });
}

// This method will apply the needed animation and displacement.

slider.prototype.transition=function(coords){
    this.container.animate({
        'margin-left': coords || -(this.current*this.width) // First element is multiplied by Zero.
    },500);
    // Remove CSS from Rest other pagination element in the list.
    this.pagicontainer.find('li a').css({
      border : "none",
      fontWeight:"",
      fontSize:"",
      background: "none"
    });
    // Apply CSS to current pagination element in the list.
    this.pagicontainer.find('li').find("[data-pgno='" + this.current + "']").css({
      //border : "2px solid grey",
      //fontWeight:"900",
      //fontSize:"18px"
      width: "14px",
      height: "14px",
      border: "1px solid",
      background: "#fff",
      borderRadius: "7px"
    });
};

// This method will set the "current" counter to next position.
/*
Parameters are:-
---------------
1) dir -> It can be either 'prev' or 'next' or else a number denoting slides.
*/
slider.prototype.setCurrentPos=function(dir){
    var pos=this.current;
    //console.log('Value of this.value is : '+dir);
    if(isNaN(dir))
    {
        pos+= ~~(dir=='next') || -1; // You can use alternate "Math.floor()" method instead of double tilde (~~) operator.
        this.current=(pos<0)?this.imgLen-1: pos%(this.imgLen);
    }
    else
        this.current=Number(dir);
    //console.log(this.current);

};

// website image link hover effect
$('.website-white-link').hover(function () {
   // create the hover effect for the associated text
   $('div.website-img-swap').css({'background-position': '0 100%'});
   $('div.share-text-white.site').css({color: '#197BC2'});
}, function () {
    $('div.website-img-swap').css({'background-position': '0 0'});
    $('div.share-text-white.site').css({color: '#fff'});
});

// website image link hover effect
$('.website-black').hover(function () {
   // create the hover effect for the associated text
   $('div.website-img-swap-black').css({'background-position': '0 100%'});
   $('div.share-text-white.site').css({color: '#197BC2'});
}, function () {
    $('div.website-img-swap-black').css({'background-position': '0 0'});
    $('div.share-text-white.site').css({color: '#000'});
});
    </script>
<div id="nygov-universal-footer">
    <noscript>
        <iframe width="100%" height="200px" src="//static-assets.ny.gov/load_global_footer/ajax?iframe=true" frameborder="0" style="border:none; overflow:hidden; width:100%; height:200px;" scrolling="no">
            Your browser does not support iFrames
        </iframe>
    </noscript>
</div>

<?php wp_footer(); ?>

</body>
</html>

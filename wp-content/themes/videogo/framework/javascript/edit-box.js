/**
 *	CrunchPress Edit Box File
 *	---------------------------------------------------------------------
 * 	@version	1.0
 * 	@author		CrunchPress
 * 	@link		http://crunchpress.com
 * 	@copyright	Copyright (c) CrunchPress
 * 	---------------------------------------------------------------------
 * 	This file contains the script of the editbox that create overlay over
 *	any elements and copy desired element to be showed in that overlay.
 *	---------------------------------------------------------------------
 */
jQuery(document).ready(function () {
    // initialize necessary variables
    var lawyerpro_div_wrapper = jQuery('#cp-overlay-wrapper');
    var lawyerpro_edit_box_elements = {
        editbox: '<div class="bootstrap_admin" id="cp-edit-box">\
					<div id="cp-overlay"></div>\
					<div id="cp-overlay2"></div>\
					<div class="" id="cp-inline-wrapper">\
						<div class="cp-inline-header">\
							<div class="cp-inline-header-wrapper">\
								<div class="cp-inline-header-inner-wrapper" >\
									<div class="cp-inline-header-text"> EDITOR </div>\
									<div id="cp-head-edit-img" class="cp-head-edit-img"></div>\
								</div>\
							</div>\
							<div id="close-cp-edit-box"></div>\
						</div>\
						<div class="container-fluid" id="cp-inline"></div>\
						<div class="cp-inline-footer">\
							<input type="button" value="Done" id="cp-inline-edit-done" class="cp-button">\
							<br class="clear">\
						</div>\
					</div>\
				</div>',
        opacity: 0.42
    };
    lawyerpro_div_wrapper.append(lawyerpro_edit_box_elements.editbox);
    var lawyerpro_editbox = lawyerpro_div_wrapper.find('#cp-edit-box');
    var lawyerpro_content = lawyerpro_editbox.siblings('#cp-overlay-content');
    var lawyerpro_overlay = lawyerpro_editbox.find('#cp-overlay');
    var lawyerpro_inline = lawyerpro_editbox.find('#cp-inline');
    var lawyerpro_clicked_item = '';
    var lawyerpro_item_size = '';
    var lawyerpro_edit_item = '';
    var lawyerpro_clone_item = '';
    // bind the initialize elements
    lawyerpro_editbox.children().css('display', 'none');
    lawyerpro_overlay.css('opacity', lawyerpro_edit_box_elements.opacity);
    jQuery('#close-cp-edit-box').click(function () {
        lawyerpro_close_editbox();
    });
    jQuery('#cp-inline-edit-done').click(function () {
        lawyerpro_close_editbox();
    });
    jQuery('div[rel="cp-edit-box"]').click(function () {
        lawyerpro_clicked_item = jQuery(this);
        lawyerpro_item_size = lawyerpro_clicked_item.parents('#page-element-item').find('#element-size-text').html();
        lawyerpro_item_size = parseInt(lawyerpro_item_size.substr(0, 1)) / parseInt(lawyerpro_item_size.substr(2, 1));
        lawyerpro_open_editbox();
    });
    jQuery('input#publish[name="save"]').click(function () {
        lawyerpro_close_editbox();
    });
    // copy the content and open the edit box to use
    function lawyerpro_open_editbox() {
        clicked_id = lawyerpro_clicked_item.attr('id');
        lawyerpro_edit_item = lawyerpro_clicked_item.parents('#page-element-item').siblings('#' + clicked_id);
        lawyerpro_clone_item = lawyerpro_edit_item.children().clone(true);
        var li_cloned = lawyerpro_clone_item.find('div.selected-image ul').children().clone(true);
        li_cloned = jQuery('<ul></ul>').append(li_cloned);
        lawyerpro_clone_item.find('div.selected-image ul').replaceWith(li_cloned)
        lawyerpro_clone_item.find('div.selected-image ul').sortable({
            tolerance: 'pointer',
            forcePlaceholderSize: true,
            placeholder: 'slider-placeholder',
            cancel: '.slider-detail-wrapper'
        });
        //lawyerpro_clone_item.css('display','block');
        // Remove unnecessary size
        lawyerpro_clone_item.find("#page-option-item-testimonial-size, #page-option-item-portfolio-size, \
			#page-option-item-blog-size, #page-option-item-page-size").children("option").each(function () {
            var item_size = jQuery(this).html();
            if (item_size == "Widget Style") {
                item_size = 1 / 8;
            } else {
                item_size = parseInt(item_size.substr(0, 1)) / parseInt(item_size.substr(2, 1));
            }
            if (lawyerpro_item_size >= item_size) {
                jQuery(this).css('display', 'block');
            } else {
                jQuery(this).css('display', 'none');
            }
        });
        lawyerpro_inline.append(lawyerpro_clone_item);
        // Open Process
        lawyerpro_editbox.children().fadeIn(600);
        lawyerpro_content.hide(function () {
            jQuery(this).css('position', 'absolute');
            jQuery(this).show();
        });
    }
    // manipulate the edited content and close editbox 
    function lawyerpro_close_editbox() {
        var lawyerpro_edited_item = lawyerpro_inline.children().clone(true);
        if (lawyerpro_edit_item) {
            lawyerpro_edit_item.html(lawyerpro_edited_item);
        }
        lawyerpro_clear_editbox();
    }
    // clear the editbox variables and internal content
    function lawyerpro_clear_editbox() {
        lawyerpro_content.hide(0, function () {
            lawyerpro_content.css('position', 'relative');
            lawyerpro_content.slideDown(600);
            lawyerpro_editbox.children().fadeOut(function () {
                lawyerpro_inline.children().remove();
                lawyerpro_edit_item = '';
                lawyerpro_clone_item = '';
                lawyerpro_clicked_item = '';
            });
        });
    }
    jQuery.fn.bindEditBox = function () {
        lawyerpro_clicked_item = jQuery(this);
        lawyerpro_open_editbox();
    }
});
// Fix the clone problem of <textarea> and <select> elements
(function (original) {
    jQuery.fn.clone = function () {
        var result = original.apply(this, arguments),
            my_textareas = this.find('textarea, select'),
            result_textareas = result.find('textarea, select');
        for (var i = 0, l = my_textareas.length; i < l; ++i)
        jQuery(result_textareas[i]).val(jQuery(my_textareas[i]).val());
        return result;
    };
})(jQuery.fn.clone);
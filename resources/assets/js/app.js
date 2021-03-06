
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

window.showRevLoader = function(){
	if($('.rev-spinner-wrapper').css('display') == 'none'){
		$('.rev-spinner-wrapper')
			.fadeIn('fast');
	}
};

window.hideRevLoader = function(){
	if($('.rev-spinner-wrapper').css('display') != 'none'){
		setTimeout(function(){
			$('.rev-spinner-wrapper')
				.fadeOut('fast');
		}, 500);
	}
};

window.mceConfig = {
				selector: '.rev-input-mce',
				height: 300,
				menubar: false,
				plugins: [
					'image textcolor code colorpicker advlist lineheight wordcount'
				],
				theme_advanced_fonts : `Andale Mono=andale mono,times;
				                Arial=arial,helvetica,sans-serif;
				                Arial Black=arial black,avant garde;
				                Book Antiqua=book antiqua,palatino;
				                Comic Sans MS=comic sans ms,sans-serif;
				                Courier New=courier new,courier;
				                Georgia=georgia,palatino;
				                Helvetica=helvetica;
				                Impact=impact,chicago;
				                Symbol=symbol;
				                Tahoma=tahoma,arial,helvetica,sans-serif;
				                Terminal=terminal,monaco;
				                Times New Roman=times new roman,times;
				                Trebuchet MS=trebuchet ms,geneva;
				                Verdana=verdana,geneva;
				                Webdings=webdings;
				                Wingdings=wingdings,zapf dingbats`,
				theme: 'modern',
				toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor | backcolor | fontsizeselect | lineheightselect | code',
				fontsize_formats: '8pt 9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 17pt 18pt 19pt 20pt 21pt 22pt 23pt 24pt 25pt 26pt 27pt 28pt 29pt 30pt 31pt 32pt 33pt 34pt 35pt 36pt'
			  };

Vue.filter('chunk', function(arr, len){
 	var chunks = [];
 	var i = 0;
 	var n = arr.length;
 	while(i < n){
 		chunks.push(arr.slice(i, i += len));
 	}
 	return chunks;
});

Vue.transition('rev-bounce', {
	enterClass: 'bounceInDown',
	leaveClass: 'bounceOutUp'
});

Vue.transition('rev-slide', {
	enterClass: 'slideInLeft',
	leaveClass: 'slideOutLeft'
});

Vue.component('rev-pages', require('./revcms-components/pages/pages.vue'));
Vue.component('rev-create-page', require('./revcms-components/pages/create-page.vue'));

Vue.component('rev-media-library', require('./revcms-components/media/media-library.vue'));
Vue.component('rev-media-items', require('./revcms-components/media/media-items.vue'));

Vue.component('rev-themes', require('./revcms-components/theme/themes.vue'));
Vue.component('rev-theme-card', require('./revcms-components/theme/theme-card.vue'));
// MVC Menu
Vue.component('rev-controllers', require('./revcms-components/mvc/controllers.vue'));
Vue.component('rev-controller-maker', require('./revcms-components/mvc/controller-maker.vue'));

const app = new Vue({
    el: '#rev-cms-app'
});

(function($){
	$(function(){
		$('[data-toggle="rev-dropdown"]')
			.on('click', function(e){
				e.preventDefault();
				let target = $(this).attr('href') ? $(this).attr('href') : $(this).data('target');
				if($(target).hasClass('bounceInDown')){
					$(target).removeClass('bounceInDown')
								.addClass('bounceOutUp');
					$(this).children('.fa')
							.removeClass('fa-caret-up')
							.addClass('fa-caret-down');
					return false;
				}
				$(target)
					.removeClass('bounceOutUp')
					.css('display', 'block')
					.addClass('bounceInDown');
				$(this).children('.fa')
						.removeClass('fa-caret-down')
						.addClass('fa-caret-up');
			});
	});
})(window.jQuery);
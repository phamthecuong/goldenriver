$(document).ready(function() {
	tinymce.init({
		selector: '.tiny_mce',
		plugins: [
			'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
			'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
			'save table contextmenu directionality emoticons template paste textcolor filemanager responsivefilemanager'
		],
		toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons',
		image_advtab: true,
		external_filemanager_path: "/filemanager/",
		filemanager_title: "Responsive Filemanager",
		external_plugins: {
			"responsivefilemanager": "/js/plugins/tinymce/plugins/responsivefilemanager/plugin.min.js",
			"filemanager": "/filemanager/plugin.min.js"
		},
	});
});

var cms = {
	confirm: function(msg = 'Are you sure allow this action?') {
		return confirm(msg);
	}
};
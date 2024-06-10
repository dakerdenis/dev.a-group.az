CKEDITOR.editorConfig = function( config ) {
    config.toolbarGroups = [
        { name: 'styles', groups: [ 'styles' ] },
        { name: 'colors', groups: [ 'colors' ] },
        { name: 'links', groups: [ 'links' ] },
        { name: 'others', groups: [ 'others' ] },
        { name: 'basicstyles', groups: [ 'basicstyles' ] },
        { name: 'paragraph', groups: [ 'list', 'align', 'paragraph', 'lightbox'] },
        { name: 'document', groups: [ 'mode' ] },
    ];

    config.removeButtons = 'Underline,Subscript,Superscript,Image,Flash,Iframe,Table,Save,NewPage,Preview,Print,Language,Maximize';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';
	config.extraPlugins = 'lightbox,lightbox2';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
    config.allowedContent = true;
    config.height = 500;

    config.filebrowserImageBrowseUrl = '/file-manager/ckeditor';

    config.defaultLanguage = 'ru';
    config.language = 'ru';
};

  CKEDITOR.plugins.add('lightbox', {
    icons: 'lightbox', // %REMOVE_LINE_CORE%
    init: function( editor ) {
      CKEDITOR.dialog.add( 'image_fancy', this.path + 'dialogs/image_fancy.js' );
      editor.addCommand( 'startSearch', new CKEDITOR.dialogCommand( 'image_fancy' ));
      if ( editor.ui.addButton ) {
        editor.ui.addButton( 'lightbox', {
          label: 'Image Upload',
          id: 'lightbox',
          command: 'startSearch',
          toolbar: 'lightbox,100',
        } );
      }
    }
  } );

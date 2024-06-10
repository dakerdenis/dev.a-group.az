  CKEDITOR.plugins.add('lightbox2', {
    icons: 'lightbox2', // %REMOVE_LINE_CORE%
    init: function( editor ) {
      CKEDITOR.dialog.add( 'image_tour', this.path + 'dialogs/image_tour.js' );
      editor.addCommand( 'startSearchA', new CKEDITOR.dialogCommand( 'image_tour' ));
      if ( editor.ui.addButton ) {
        editor.ui.addButton( 'lightbox2', {
          label: 'Тур',
          id: 'lightbox2',
          command: 'startSearchA',
          toolbar: 'lightbox2,100',
        } );
      }
    }
  } );

  CKEDITOR.plugins.add('file', {
    icons: 'file', // %REMOVE_LINE_CORE%
    init: function( editor ) {
      CKEDITOR.dialog.add( 'file_dialog', this.path + 'dialogs/file_dialog.js' );
      editor.addCommand( 'startFile', new CKEDITOR.dialogCommand( 'file_dialog' ));
      if ( editor.ui.addButton ) {
        editor.ui.addButton( 'file', {
          label: 'File Upload',
          id: 'file',
          command: 'startFile',
          toolbar: 'file,101',
        } );
      }
    }
  } );

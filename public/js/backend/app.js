/* TINY MCE */

tinymce.init({ 

  selector  : 'textarea#content-article',
  /*plugins   : 'image, lists, advlist, code',
  toolbar   : 'newdocument code image | undo redo | bold italic underline strikethrough alignleft aligncenter alignright alignjustify styleselect formatselect fontselect fontsizeselect | cut copy paste bullist numlist outdent indent blockquote removeformat subscript superscript',*/
  //menubar   : true // Barre de menu tout en haut
  //toolbar: 'bullist, numlist',
  menubar: true,
  language_url: 'https://olli-suutari.github.io/tinyMCE-4-translations/fr_FR.js',
  language: 'fr_FR'

});

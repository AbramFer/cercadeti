$.fn.selectOption = function() {

   return this.each(function() { //para cada combo box ejecutamos la siguiente funcion 
      id = $(this).attr('id');
      //el "selected" se podria cambiar por "title" u otro atributo si queremos un html mas valido
      val = $(this).attr('fake');
      //si no hay un id, agregamos uno temporalmente
      if(!id) {
         id = 'fake_id';
         $(this).attr('id', 'fake_id');
         fakeId = true;
      } else {
         fakeId = false;
      }
         
      if(val) {
      
         //y aqui lo mas importante, utilizamos el selector de jquery para buscar el option que necesita
         //el atributo selected y agregarselo...
         $('#' + id + ' option[value="'+val+'"]').attr('selected', 'selected');
      }
      
      //eliminamos el id temporal en caso de haberlo utilizado
      if(fakeId) {
          $(this).removeAttr('id');
      }
      
   });
}

$(window).on("load",function() {
   //llamamos nuestra función para todos los combobox o elementos select
   //podríamos cambiar aquí a algo como: select.MI_CLASE o select#MI_ID
   $("select.form-control").selectOption();
   
});


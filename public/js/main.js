$('#datepicker').datepicker({
  autoclose: true,
  format: 'dd-mm-yyyy',
})

function confirmDelete(event) {
  if(!confirm("Apakah anda yakin"))
      event.preventDefault();
}

$('.select2').select2()

function previewImages() {
  var $preview = $('#preview').empty();
  if (this.files) $.each(this.files, readAndPreview);

  function readAndPreview(i, file) {
    if (!/\.(jpe?g|png|gif)$/i.test(file.name)){
      return alert(file.name +" is not an image");
    } // else...

    var reader = new FileReader();
    $(reader).on("load", function() {
      $preview.append($("<img/>", {src:this.result, height:100}));
    });
    reader.readAsDataURL(file);
  }
}

$('#file-input').on("change", previewImages);

$('.btn-submit').click(function (e) {
	e.preventDefault()
	Swal.fire({
		title: "Apakah anda yakin ?",
		text: "Data akan tersimpan dalam sistem",
		icon: "question",
		showCancelButton: true,
		confirmButtonText: 'Yes',
		cancelButtonText: 'No'
	}).then((result) => {
		if (result.isConfirmed) {
			this.closest("form").submit()
		}
	})
})
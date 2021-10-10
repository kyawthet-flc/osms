window.createCheckbox = function(name, value, label, id, attributes) {
    let checkbox = "";
    checkbox += '<div class="form-check form-check-inline">';
    checkbox +=
        '<input class="form-check-input" type="checkbox" id="checkbox-' +
        id +
        '" value="' +
        value +
        '" name="' +
        name +
        '"  ' +
        attributes +
        ">";
    checkbox +=
        '<label class="form-check-label" for="checkbox-' +
        id +
        '">' +
        label +
        "</label>";
    checkbox += "</div>";

    return checkbox;
};

window.createTextbox = name => {
    let textbox = "";
    textbox += '<div class="form-group">';
    textbox += '<input type="text" class="form-control" name="' + name + '" >';
    textbox += "</div>";
    return textbox;
};

$(".custom-file-input").on("change", function(e) {
    var fileName = $(this).val();
    var nextSibling = e.target.nextElementSibling;
    nextSibling.innerText = fileName;
});

/*$("form").submit(function() {
    $(this)
        .find(":submit")
        .attr("disabled", "disabled");
});
*/

$(".btn-danger").not(".no-alert").click(function() {
    return confirm("Are you sure?");
});

//select 2
// $(".select2-lib").select2();

//date range picker start
$(".daterangepicker-lib").daterangepicker({
    autoUpdateInput: false,
    locale: {
        format: 'DD/MM/YYYY'
    }
});

$(".daterangepicker-lib").attr("autocomplete","off");

$('.daterangepicker-lib').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
});

$('.daterangepicker-lib').on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
});
//daterangepicker end

//add active class to nav-link
$('.nav-link[href="'+window.location.href.split('?')[0]+'"]').addClass('active');

$('.nav-link[href="'+window.location.href+'"]').addClass('active');

//add sidebar active
$('.sidebar-nav a[href="'+window.location.href+'"]').parent().addClass('sidebar-active');

//summernote start
$('.summernote-lib').summernote({
    height: 200,
    toolbar: [
        ['style', ['style']],
        ['font', ['italic', 'bold', 'underline', 'clear']],
        ['fontname', ['fontname']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        // ['insert', ['link']],
        // ['view', ['codeview', 'help']],
        ['insert', ['link', 'picture', 'video', 'hr', 'codeview']]
      ],
});


$("input[input-type='number']").on('keyup change', function(e) {
               
    if (/\D/g.test($(this).val())) {
       this.value = $(this).val().replace(/\D/g, '');
    } else if( $(this).val() == 0 ) {
       this.value = ''
    }
});
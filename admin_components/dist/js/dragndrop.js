$('.dr').on("dragstart", function (event) {
    var dt = event.originalEvent.dataTransfer;
    dt.setData('Text', $(this).attr('id'));

});

$('#div1').on("dragenter dragover drop", function (event) {
    event.preventDefault();
    if (event.type === 'drop') {
        var old = $(this).find('.dr').detach()
        old.appendTo('#drag').removeAttr('style')
        var data = event.originalEvent.dataTransfer.getData('Text', $(this).attr('id'));
        de = $('#' + data).detach();
        de.css({'position': 'absolute', 'top': 0 + 'px', 'left': 0 + 'px'}).appendTo($("#div1 .thumbBox"));
        alert(data);
    }
    ;
});

$('#div2').on("dragenter dragover drop", function (event) {
    event.preventDefault();
    if (event.type === 'drop') {
        var old = $(this).find('.dr').detach()
        old.appendTo('#drag').removeAttr('style')
        var data = event.originalEvent.dataTransfer.getData('Text', $(this).attr('id'));
        de = $('#' + data).detach();
        de.css({'position': 'absolute', 'top': 0 + 'px', 'left': 0 + 'px'}).appendTo($("#div2 .thumbBox"));
        alert(data);
    }
    ;
});

$('#div3').on("dragenter dragover drop", function (event) {
    event.preventDefault();
    if (event.type === 'drop') {
        var old = $(this).find('.dr').detach()
        old.appendTo('#drag').removeAttr('style')
        var data = event.originalEvent.dataTransfer.getData('Text', $(this).attr('id'));
        de = $('#' + data).detach();
        de.css({'position': 'absolute', 'top': 0 + 'px', 'left': 0 + 'px'}).appendTo($("#div3 .thumbBox"));
        alert(data);
    }
    ;
});

$('#div4').on("dragenter dragover drop", function (event) {
    event.preventDefault();
    if (event.type === 'drop') {
        var old = $(this).find('.dr').detach()
        old.appendTo('#drag').removeAttr('style')
        var data = event.originalEvent.dataTransfer.getData('Text', $(this).attr('id'));
        de = $('#' + data).detach();
        de.css({'position': 'absolute', 'top': 0 + 'px', 'left': 0 + 'px'}).appendTo($("#div4 .thumbBox"));
        alert(data);
    }
    ;
});

$('#div5').on("dragenter dragover drop", function (event) {
    event.preventDefault();
    if (event.type === 'drop') {
        var old = $(this).find('.dr').detach()
        old.appendTo('#drag').removeAttr('style')
        var data = event.originalEvent.dataTransfer.getData('Text', $(this).attr('id'));
        de = $('#' + data).detach();
        de.css({'position': 'absolute', 'top': 0 + 'px', 'left': 0 + 'px'}).appendTo($("#div5 .thumbBox"));
        alert(data);
    }
    ;
});

$('#div6').on("dragenter dragover drop", function (event) {
    event.preventDefault();
    if (event.type === 'drop') {
        var old = $(this).find('.dr').detach()
        old.appendTo('#drag').removeAttr('style')
        var data = event.originalEvent.dataTransfer.getData('Text', $(this).attr('id'));
        de = $('#' + data).detach();
        de.css({'position': 'absolute', 'top': 0 + 'px', 'left': 0 + 'px'}).appendTo($("#div6 .thumbBox"));
        alert(data);
    }
    ;
});

$('#div7').on("dragenter dragover drop", function (event) {
    event.preventDefault();
    if (event.type === 'drop') {
        var old = $(this).find('.dr').detach()
        old.appendTo('#drag').removeAttr('style')
        var data = event.originalEvent.dataTransfer.getData('Text', $(this).attr('id'));
        de = $('#' + data).detach();
        de.css({'position': 'absolute', 'top': 0 + 'px', 'left': 0 + 'px'}).appendTo($("#div7 .thumbBox"));
        alert(data);
    }
    ;
});

$('#div8').on("dragenter dragover drop", function (event) {
    event.preventDefault();
    if (event.type === 'drop') {
        var old = $(this).find('.dr').detach()
        old.appendTo('#drag').removeAttr('style')
        var data = event.originalEvent.dataTransfer.getData('Text', $(this).attr('id'));
        de = $('#' + data).detach();
        de.css({'position': 'absolute', 'top': 0 + 'px', 'left': 0 + 'px'}).appendTo($("#div8 .thumbBox"));
        alert(data);
    }
    ;
});

$('#div9').on("dragenter dragover drop", function (event) {
    event.preventDefault();
    if (event.type === 'drop') {
        var old = $(this).find('.dr').detach()
        old.appendTo('#drag').removeAttr('style')
        var data = event.originalEvent.dataTransfer.getData('Text', $(this).attr('id'));
        de = $('#' + data).detach();
        de.css({'position': 'absolute', 'top': 0 + 'px', 'left': 0 + 'px'}).appendTo($("#div9 .thumbBox"));
        alert(data);
    }
    ;
});
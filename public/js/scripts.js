
function cardRaining() {
    $.fn.duplicate = function (a, b) {
        var c = [];
        for (var d = 0; d < a; d++) $.merge(c, this.clone(b).get());
        return this.pushStack(c);
    };
    var cr = $(".card-popup-raining");
    cr.each(function (cr) {
        var starcount = $(this).attr("data-starrating");
        $("<i class='fa fa-star'></i>").duplicate(starcount).prependTo(this);
    });
}


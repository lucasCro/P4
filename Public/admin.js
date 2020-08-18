jQuery(document).ready(function() {
	// fonction pour afficher / masquer les div du menu admin
	function isItShow(itemDisplay) {
		let result;
		let show = $(itemDisplay).css('display');

		if(show == "none") {
			result = false;
		} else {
			result = true;
		}

		return result;
	}

	function show(item) {
		$(item).css({
			display : "flex",
			flexDirection : "column"
		});
	}

	function hide(item) {
		$(item).css('display', 'none');
	}

	function displayOnClick(whereToClick) {
		let itemDisplay = $(whereToClick + "+ div");

		$(whereToClick).on('click', function() {

			if (isItShow(itemDisplay) == false){
				show(itemDisplay);
			} else {
				hide(itemDisplay);
			}
	    });
	}

	let displayButton = [
	"#btn_div_chapitres",
	"#btn_div_contacts",
	"#btn_div_commentaires",
	"#btn_underMenu_reported_comments",
	"#btn_underMenu_chapter_list",
	"#btn_underMenu_creation_chapter",
	"#btn_underMenu_draft_list",
	"#btn_underMenu_valid_comments",
	"#btn_underMenu_all_comments"
	];

	for (let item of displayButton){
		displayOnClick(item);
	}

	// fonction pour ouvrir des pop up apres clique sur "lire la suite"
	$(".read_more").on('click', function() {
		let url = this.attr('href');
		window.open(url, "", "width=500, height=700");
	})

});

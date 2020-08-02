jQuery(document).ready(function(){

	function isItShowed(itemDisplay) {
		let result;
		let show = $(itemDisplay).css('display');

		if(show == "none") {
			result = false;
		} else {
			result = true;
		}

		return result;
	}

	function show(item){
		$(item).css({
			display : "flex",
			flexDirection : "column"
		});
	}

	function hide(item){
		$(item).css('display', 'none');
	}

	function displayOnClick(whereToClick) {
		let itemDisplay = $(whereToClick + "+ div");

		$(whereToClick).on('click', function(){

			if (isItShowed(itemDisplay) == false){
				show(itemDisplay);
			} else {
				hide(itemDisplay);
			}
	    });
	}

	let showerButton = [
	"#btn_div_chapitres",
	"#btn_div_contacts",
	"#btn_div_commentaires",
	"#btn_underMenu_reported_comments",
	"#btn_underMenu_chapter_list",
	"#btn_underMenu_creation_chapter",
	"#btn_underMenu_draft_list"
	];

	for (let item of showerButton){
		displayOnClick(item);
	}
});

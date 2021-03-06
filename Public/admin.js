jQuery(document).ready(function() {
	// Cache les div pour ne laisser que les boutons de navigations visible
	let hiddenDiv = [
		"#div_admin_commentaires",
		"#div_admin_contacts",
		"#div_admin_chapitres",
		".btn_underMenu + div"
	]
	// fonctions pour afficher / masquer les div du menu admin
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

	for(let item of displayButton) {
		displayOnClick(item);
	}

	// for(let div of hiddenDiv) {
	// 	hide(div);
	// }

	// fonction pour ouvrir des pop up apres clique sur "lire la suite"
	$(".read_more").on('click', function(event) {
		event.preventDefault();
		let url = this.href;
		let window_width = 0.9*($(window).width());
		// etablir une max width
		if(window_width > 1100 ) { window_width = 1100 ;}
		let window_height = 0.9*($(window).height());
		window.open(url, "", "scrollbars=yes,resizable=yes,top=50,left=500,width="+window_width+",height="+window_height);
	})

	// fonction pour target la l onglet creation chapitre apres avoir cliqué sur "modifier" pour un chapitre
	$(".btn_modify_chapter").on('click', function() {
		// affiche la div creation chapitre
		$("#div_tinyMCE").toggle();		
	});
});

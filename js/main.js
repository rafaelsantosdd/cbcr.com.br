$(function(){

	// SMOOTH SCROLL

	var $root = $('html, body');

	$('.site_nav a[href^="#"]').click(function () {
		$root.animate({
			scrollTop: $( $.attr(this, "href") ).offset().top - 90
		}, 400);

		return false;
	});

	// MENU MOBILE

	var burguer = $(".menu_burguer"),
		menuMobile = $(".menu_mobile_wrap"),
		menuMobileBox = $(".menu_mobile");

	burguer.click(function(){
		if(!$(this).hasClass("open")) {
			$(this).addClass("open");
			menuMobile.addClass("open");
			$("html, body").addClass("no-scroll");
		} else {
			closeMobileMenu();
		}
	});

	$(document).mouseup(function(e){
		if (menuMobile.hasClass("open")) {
			if ((!menuMobileBox.is(e.target) && menuMobileBox.has(e.target).length === 0 && e.target != burguer && burguer.has(e.target).length === 0) 
				|| (!menuMobileBox.is(e.target) && menuMobileBox.has(e.target).length > 0 && e.target == burguer && burguer.has(e.target).length > 0)) {
				closeMobileMenu();
				console.log(e.target);
			}
		}
	});

	$(".menu_mobile a").click(function(){
		closeMobileMenu();
	});

	function closeMobileMenu() {
		burguer.removeClass("open");
		menuMobile.removeClass("open");
		$("html, body").removeClass("no-scroll");
	}




	// FIXED MENU

	var fixedMenu = $(".fixed_header"),
		offsetTop = $(".hero_call_minor").offset().top;

		testScroll();

	$(window).scroll(function(){
		testScroll();
	});

	function testScroll() {
		if($(this).scrollTop() > offsetTop) {
			fixedMenu.addClass("fixed_header--visible");
			$(".menu_burguer_fixed").addClass("visible");
		} else {
			fixedMenu.removeClass("fixed_header--visible");
			$(".menu_burguer_fixed").removeClass("visible");
		}
	}



	// TEAM INFO

	var closeTeam = $(".ranking_team_close"),
		teamInfo = $(".ranking_team_group"),
		teamInfoPage = $(".ranking_team"),
		tableRow = $(".ranking_table tbody tr");

	tableRow.click(function(){
		var teamSeries,
			teamPos = $(this).children(".column-1").html(),
			teamWins = $(this).children(".column-4").html(),
			teamLoses = $(this).children(".column-5").html(),
			teamSaldo = $(this).children(".column-6").html(),
			teamJogos = $(this).children(".column-7").html(),
			teamTag = $(this).children(".column-8").html(),
			teamRoster = $(".ranking_team_roster"),
			teamStaff = $(".ranking_team_staff"),
			teamGroupTable = $(this).parents(".tablepress");

			if($(this).parents(".ranking_table").hasClass("table--seriea")) {
				teamSeries = "A";
			} else if($(this).parents(".ranking_table").hasClass("table--serieb")) {
				teamSeries = "B";
			}

		$.ajax({
			type: "GET",
			url: "http://cbcr.com.br/wp-content/themes/cbcr-v1/js/teams.json",
			contentType: "application/json; charset=utf-8",
			cache: true,
			error: function() {
				$(".ranking_team_name").html("Houve um erro com os dados dos times. Atualize a página e tente novamente.");
			},
			success: function(data) {
				// document.getElementsByClassName("ranking_team").scrollTo(0,0);
				teamRoster.empty();
				teamStaff.empty();
				$(".js--teaminfo_social").empty();

				if(teamSeries == "A") {
					changeTeamInfo(data[0].teams);
				} else if(teamSeries == "B") {
					changeTeamInfo(data[1].teams);
				}

				teamInfo.addClass("open");
				$("html, body").addClass("no-scroll");
			}
		});

		function changeTeamInfo(list) {
			$.each(list, function(i, team){
				if(team.id == teamTag) {
					var logoUrl = "http://cbcr.com.br/wp-content/themes/cbcr-v1/imgs/teams/" + team.id + ".png",
						logoBgUrl = "http://cbcr.com.br/wp-content/themes/cbcr-v1/imgs/teamsbg/" + team.id + ".png",
						playerTwitter,
						playerCountry;

					$(".js--teaminfo_logo").attr("src", logoUrl).attr("alt", team.id);
					$(".js--teaminfo_logo-bg").attr("src", logoBgUrl).attr("alt", team.id);
					$(".js--teaminfo_name").html(team.name);
					$(".js--teaminfo_series").html(teamSeries);
					$(".js--teaminfo_pos").html(teamPos + "º");
					$(".js--teaminfo_wins").html(teamWins);
					$(".js--teaminfo_loses").html(teamLoses);
					$(".js--teaminfo_saldos").html(teamSaldo);
					$(".js--teaminfo_jogos").html(teamJogos);

					if(teamGroupTable.hasClass("tablepress-id-a1") || teamGroupTable.hasClass("tablepress-id-b1")) {
						$(".js--teaminfo_group").html("1");
					} else if(teamGroupTable.hasClass("tablepress-id-a2") || teamGroupTable.hasClass("tablepress-id-b2")) {
						$(".js--teaminfo_group").html("2");
					}

					if(team.social.web != "") {
						setSocial(team.social.web, "fas fa-globe");
					}
					if(team.social.twitter != "") {
						setSocial(team.social.twitter, "fab fa-twitter");
					}
					if(team.social.facebook != "") {
						setSocial(team.social.facebook, "fab fa-facebook-f");
					}
					if(team.social.instagram != "") {
						setSocial(team.social.instagram, "fab fa-instagram");
					}

					$.each(team.players, function(i, player) {
						if (player.twitter != "") {
							playerTwitter = "<div class='ranking_team_player_social'><a target='_blank' href='https://twitter.com/" + player.twitter + "' class='ranking_team_player_social_icon'><i class='fab fa-twitter'></i></a></div>";
						} else {
							playerTwitter = "";
						}

						if (player.country != "") {
							playerCountry = "<img src='http://cbcr.com.br/wp-content/themes/cbcr-v1/imgs/flags/" + player.country + ".png' alt='" + player.nick + "' class='ranking_team_player_country'>";
						} else {
							playerCountry = "";
						}

						teamRoster.append("<div class='ranking_team_player'><div class='ranking_team_player_card'><div class='ranking_team_player_photo'><div class='ranking_team_player_photocontainer'><img src='http://cbcr.com.br/wp-content/themes/cbcr-v1/imgs/players/" + player.url + "' alt='" + player.nick + "'></div>" + playerCountry + "</div><div class='ranking_team_player_info'><div class='ranking_team_player_naming'><p class='ranking_team_player_nick'>" + player.nick + "</p></div>" + playerTwitter + "<a target='_blank' href='https://royaleapi.com/player/" + player.tag + "' class='ranking_team_player_tag'>#" + player.tag + "</a></div></div></div>");
					});

					$.each(team.staffs, function(i, staff) {
						if (staff.twitter != "") {
							playerTwitter = "<div class='ranking_team_player_social'><a target='_blank' href='https://twitter.com/" + staff.twitter + "' class='ranking_team_player_social_icon'><i class='fab fa-twitter'></i></a></div>";
						} else {
							playerTwitter = "";
						}

						if (staff.country != "") {
							playerCountry = "<img src='http://cbcr.com.br/wp-content/themes/cbcr-v1/imgs/flags/" + staff.country + ".png' alt='" + staff.nick + "' class='ranking_team_player_country'>";
						} else {
							playerCountry = "";
						}

						teamStaff.append("<div class='ranking_team_player'><div class='ranking_team_player_card'><div class='ranking_team_player_photo'><div class='ranking_team_player_photocontainer'><img src='http://cbcr.com.br/wp-content/themes/cbcr-v1/imgs/players/" + staff.url + "' alt='" + staff.nick + "'></div><p class='ranking_team_player_role'>" + staff.role + "</p>" + playerCountry + "</div><div class='ranking_team_player_info'><div class='ranking_team_player_naming'><p class='ranking_team_player_nick'>" + staff.nick + "</p></div>" + playerTwitter + "<a target='_blank' href='https://royaleapi.com/player/" + staff.tag + "' class='ranking_team_player_tag'>#" + staff.tag + "</a></div></div></div>");
					});
				}
			});
		}

		function setSocial(url, type) {
			$(".js--teaminfo_social").append("<a href='" + url + "' target='_blank' class='ranking_team_social_icon'><i class='" + type + "'></i></a>")
		}
	});

	closeTeam.click(function(){
		closeTeamInfo();
	});

	$(document).mouseup(function(e){
		if (teamInfo.hasClass("open")) {
			if ((!teamInfoPage.is(e.target) && teamInfoPage.has(e.target).length === 0 && e.target != closeTeam) 
				|| (!teamInfoPage.is(e.target) && teamInfoPage.has(e.target).length > 0 && e.target == closeTeam)) {
				closeTeamInfo();
				console.log(e.target);
			}
		}
	});

	$(".menu_mobile a").click(function(){
		closeTeamInfo();
	});

	function closeTeamInfo() {
		teamInfo.removeClass("open");
		$("html, body").removeClass("no-scroll");
	}




	// CONTROLADORES CLASSIFICAÇÃO

	var rankControl = $(".ranking_controller"),
		rankSection = $(".ranking"),
		serieATable = $(".table--seriea")
		serieBTable = $(".table--serieb");

	rankControl.click(function(){
		event.preventDefault();

		if($(this).hasClass("disabled")) {
			rankControl.addClass("disabled");
			$(this).removeClass("disabled");

			if(rankSection.hasClass("ranking--b")){
				rankSection.removeClass("ranking--b");
				serieATable.show();
				serieBTable.hide();
				teamInfoPage.addClass("--a");
				teamInfoPage.removeClass("--b");
			} else {
				rankSection.addClass("ranking--b");
				serieATable.hide();
				serieBTable.show();
				teamInfoPage.addClass("--b");
				teamInfoPage.removeClass("--a");
			}
		}
	});


	// POSITION TEAMS

	fixLadder($(".tablepress-id-a1"));
	fixLadder($(".tablepress-id-a2"));
	fixLadder($(".tablepress-id-b1"));
	fixLadder($(".tablepress-id-b2"));


	function fixLadder(table) {
		var cells = table.find("tbody .column-1");

		cells.each(function(i,e) {
			var realPos = i + 1;

			if(realPos <= 2) {
				$(this).append("<span>" + realPos + "</span>");
			} else {
				$(this).append(realPos);
			}
		});
	}



	// SHOW MORE STATS

	$(".stats_table_showmore").click(function() {

		if ($(this).parent().hasClass("table--seriea")) {

			$(".stats_table.table--seriea").children(".stats_table_showmore").css("display", "none");
			$(".stats_table.table--seriea").children(".stats_table_showless").css("display", "flex");
			$(".stats_table.table--seriea").addClass("more");

		} else if ($(this).parent().hasClass("table--serieb")) {

			$(".stats_table.table--serieb").children(".stats_table_showmore").css("display", "none");
			$(".stats_table.table--serieb").children(".stats_table_showless").css("display", "flex");
			$(".stats_table.table--serieb").addClass("more");

		}

	});

	$(".stats_table_showless").click(function() {

		if ($(this).parent().hasClass("table--seriea")) {

			$(".stats_table.table--seriea").children(".stats_table_showmore").css("display", "flex");
			$(".stats_table.table--seriea").children(".stats_table_showless").css("display", "none");
			$(".stats_table.table--seriea").removeClass("more");

		} else if ($(this).parent().hasClass("table--serieb")) {

			$(".stats_table.table--serieb").children(".stats_table_showmore").css("display", "flex");
			$(".stats_table.table--serieb").children(".stats_table_showless").css("display", "none");
			$(".stats_table.table--serieb").removeClass("more");

		}

	});



	// ===================================
	// AGENDA SLIDER
	// ===================================

	var agendaButtonDesk = $(".agenda_controllers.--desktop ul li a")
		controllerMobile = $(".agenda_controllers.--mobile ul"),
		controllerMobileButtons = controllerMobile.children("li").children("a"),
		agendaAllSliders = $(".agenda_slider"),
		agendaAllContainers = $(".agenda_slider_container"),
		boxMatch = $(".agenda_partida_box");

	var today				= new Date(),
		day 				= today.getDay(),
		firstDayWeek1 		= new Date(2020, 6, 20),
		lastDayWeek1 		= new Date(2020, 6, 26),
		lastDayWeek2 		= new Date(2020, 7, 3),
		lastDayWeek3 		= new Date(2020, 7, 9),
		firstDayWeek4 		= new Date(2020, 7, 11),
		lastDayPlayoffs 	= new Date(2020, 7, 15),

		isWeek1 			= today >= firstDayWeek1 && today <= lastDayWeek1,
		isWeek2 			= today > lastDayWeek1 && today <= lastDayWeek2,
		isWeek3 			= today > lastDayWeek2 && today <= lastDayWeek3,
		isWeek4 			= today > lastDayWeek3 && today <= firstDayWeek4,
		isPlayoffs 			= today > firstDayWeek4 && today <= lastDayPlayoffs;


	var currentWeek;

	if (isWeek1) {

		currentWeek = 0;

	} else if (isWeek2) {

		currentWeek = 1;

	} else if (isWeek3) {

		currentWeek = 2;

	} else if (isWeek4) {

		currentWeek = 3;

	} else {

		currentWeek = 4;

	}

	console.log(today + " e " + lastDayWeek1);


		// CONTROLLERS

		controllerMobile.slick({
			infinite: false,
			centerMode: true,
			centerPadding: '0',
			slidesToShow: 1,
			initialSlide: currentWeek,
			arrows: false,
			variableWidth: true
		});

		var currentIndex = $(".agenda_controllers.--mobile li.slick-current").attr("data-slick-index");
		showSlide(currentIndex);

		agendaButtonDesk.parent().eq(currentWeek).addClass("active");

		agendaButtonDesk.click(function(){
			event.preventDefault();

			if(!$(this).parent().hasClass("active")){
				
				$(".agenda_controllers ul li.active").removeClass("active");
				$(this).parent().addClass("active");

				var index = $(this).parent().index();

				showSlide(index);
			}
		});

		controllerMobileButtons.click(function(){
			event.preventDefault();

			var li = $(this).parent();

			if(!li.hasClass("slick-current")) {
				var index = li.attr("data-slick-index");

				controllerMobile.slick('slickGoTo', index);

				showSlide(index);
			}
		})

		controllerMobile.on("afterChange", function(event, slick, currentSlide){
			showSlide(currentSlide);
			sliderHeight();
		});

		function showSlide(theIndex) {
			agendaAllContainers.each(function(i){
				if(i == theIndex) {
					agendaAllContainers.removeClass("visible");
					$(this).addClass("visible");
				}
			});
		}

		var controllerMobCont = $(".agenda_controllers.--mobile");
			controllerOffset = $(".agenda_title").offset().top + $(".agenda_title").height(),
			bottomController = $(".agenda_partida_box").height() + 90;
			sobreOffset = $(".sobre").offset().top - bottomController;


		// 	SLIDERS

		agendaAllSliders.each(function(i){

			var firstMatch;

			if (i == currentWeek && i < 4) { // É A SEMANA ATUAL E NÃO É PLAYOFFS

				if(i == 0) { // SEMANA 1 É A SEMANA ATUAL

					if (day <= 1) { 

						firstMatch = 0;

					} else if (day > 1 && day <= 3) {

						firstMatch = 4;

					} else if (day > 3 && day <= 6) {

						firstMatch = 8;

					}

				} else if(i == 1) { // SEMANA 2 É A SEMANA ATUAL

					if (today >= lastDayWeek2) {

						firstMatch = 8;

					} else if (day <= 1) {

						firstMatch = 0;

					} else if (day > 1 && day <= 3) {

						firstMatch = 4;

					} else if (day > 3) {

						firstMatch = 8;

					}

				} else if(i == 2) { // SEMANA 3 É A SEMANA ATUAL

					if (today > lastDayWeek2 && day <= 2) {

						firstMatch = 0;

					} else if (day > 2 && day <= 4) {

						firstMatch = 4;

					} else if (day > 4 && day <= 6) {

						firstMatch = 8;

					}

				} else if (i == 3) { // É A SEMANA 4

					firstMatch = 0;

				}

			} else if (i == 4) { // É PLAYOFFS

				if (currentWeek == i) { // COPA NÃO TERMINOU

					if (day <= 3) {

						firstMatch = 0;

					} else if (day > 3 && day <= 6) {

						firstMatch = 4;

					}

				} else if (today > lastDayPlayoffs) { // COPA TERMINOU

					firstMatch = 4;

				}

			} else if (i < currentWeek) { // A SEMANA JÁ PASSOU

				if (i < 3) {

					firstMatch = 8;

				} else if (i == 3) {

					firstMatch = 0;

				}

			} else { // A SEMANA AINDA NÃO CHEGOU

				firstMatch = 0;

			}

			$(this).slick({

				infinite: false,
				slidesToShow: 4,
				slidesToScroll: 4,
				initialSlide: firstMatch, 
				responsive: [
					{
						breakpoint: 1024,
						settings: {
							infinite: false,
							slidesToShow: 3,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 768,
						settings: {
							infinite: false,
							slidesToShow: 2,
							slidesToScroll: 2
						}
					},
					{
						breakpoint: 480,
						settings: "unslick"
					}
				]

			});

		});


		function sliderHeight(){
			slideHeight = $(".agenda_slider_container.visible").height();
			$(".agenda_slider_wrap").css({"height": slideHeight});
		}
		sliderHeight();

		$(window).resize(sliderHeight());




	// ===================================
	// SOBRE
	// ===================================


		var castersImage	= $(".sobre_imgs_slider"),
			castersName 	= $(".sobre_imgs_name h4"),
			castersInfo		= $(".sobre_text_caster");

		castersImage.slick({

			slidesToShow: 1,
			slidesToScroll: 1,
			dots: true,
			speed: 700

		});

		castersInfo.eq(0).show();

		castersImage.on("beforeChange", function(event, slick, currentSlide, nextSlide){
			var next 	= nextSlide,
				current = currentSlide;

			castersName.removeClass("active");

			setTimeout(function(){
				castersName.each(function(i, e){
					if(i == next) {
						$(e).addClass("active");
					}
				});
			}, 350);

			castersInfo.each(function(i, e){
				if(i == next) {
					$(e).delay(350).fadeIn(350);
				} else if(i == current) {
					$(e).fadeOut(350);
				}
			});
				
		});
});
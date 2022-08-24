
// header
const header = document.querySelector('.header');
if (header) {
	window.onscroll = function() {stickyHeader()};
	let sticky = header.offsetTop;

	function stickyHeader() {
		if (window.pageYOffset > sticky) {
			header.classList.add('sticky');
		} else {
			header.classList.remove('sticky');
		}
	}

	const headerInsureBtn = document.querySelector('.header__insure-btn');
	const headerInsureMenu = document.querySelector('.header__insure-menu');
	const headerMenuBtn = document.querySelector('.header__menu__btn');
	const headerSiteMenu = document.querySelector('.header__site-menu');

	headerInsureBtn.addEventListener('click', function() {
		this.classList.toggle('active');
		headerInsureMenu.classList.toggle('active');

		if ( headerMenuBtn.classList.contains('active') ) {
			headerMenuBtn.classList.remove('active');
			headerSiteMenu.classList.remove('active');
		} else {
			document.body.classList.toggle('menu-open');
		};
	});

	document.querySelectorAll('.header__insure-menu__card-toggler').forEach(function(elem) {
		elem.addEventListener('click', function() {
			this.classList.toggle('active');
		});
	});

	headerMenuBtn.addEventListener('click', function() {
		this.classList.toggle('active');
		headerSiteMenu.classList.toggle('active');

		if ( headerInsureBtn.classList.contains('active') ) {
			headerInsureBtn.classList.remove('active');
			headerInsureMenu.classList.remove('active');
		} else {
			document.body.classList.toggle('menu-open');
		};
	});

	const secondaryMenuTriggerMobile = document.querySelector('.header__site-menu__group .trigger');
	secondaryMenuTriggerMobile && secondaryMenuTriggerMobile.addEventListener('click', function(e) {
		e.preventDefault();
		this.classList.toggle('active');
	});

	// auth
	const headerAuthBtn = document.querySelector('.header__auth-btn');
	if ( document.querySelector('#modal-auth') ) {
		const modalAuth = document.querySelector('#modal-auth');
		// console.log(modalAuth);
		modalAuth.addEventListener('shown.bs.modal', function () {
			// modalAuth.focus();
		});
	}
	// end auth

}
// end header



const ctaSlider = new Swiper('.cta__slider', {
	slidesPerView: 1,
	centeredSLides: true,
	loop: false,
	slideToClickedSlide: true,
	centeredSlides: true,
	// autoplay: true,
	speed: 1000,
	pagination: {
		el: '.swiper-pagination',
		type: 'bullets',
		clickable: true,
		dynamicBullets: true,
		dynamicMainBullets: 5
	},
	keyboard: {
		enabled: true,
		onlyInViewport: true
	}
});

let viewportWidth = window.innerWidth || document.documentElement.clientWidth;
if (viewportWidth < 768) {
	const feedbackSLiderMobile = new Swiper('.feedback-slider-mobile', {
		slidesPerView: 'auto',
		loop: true,
		slideToClickedSlide: true,
		draggable: true,
		pagination: {
			el: '.swiper-pagination',
			type: 'bullets',
			clickable: true,
			dynamicBullets: true,
			dynamicMainBullets: 5
		}
	});

	const locationsSLiderMobile = new Swiper('.locations-slider-mobile', {
		slidesPerView: 'auto',
		loop: true,
		slideToClickedSlide: true,
		draggable: true,
		pagination: {
			el: '.swiper-pagination',
			type: 'bullets',
			clickable: true,
			dynamicBullets: true,
			dynamicMainBullets: 5
		}
	});
}

if (document.querySelector('.three-cards-swiper')) {
	const swiper = new Swiper('.three-cards-swiper', {
		slidesPerView: 3,
		loop: false,
		spaceBetween: 20,
		breakpoints: {
			0: {
				slidesPerView: 1,
				spaceBetween: 20
			},
			480: {
				slidesPerView: 2,
				spaceBetween: 20
			},
			768: {
				slidesPerView: 3,
				spaceBetween: 20
			}
		}
	});
}


var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
	return new bootstrap.Popover(popoverTriggerEl)
});

const teamSlider = document.querySelector('.team-swiper');
if (teamSlider) {
	const teamSwiper = new Swiper(teamSlider, {
		slidesPerView: 'auto',
		loop: false,
		slideToClickedSlide: true,
		draggable: true,
		pagination: {
			el: '.swiper-pagination',
			type: 'bullets',
			clickable: true,
			dynamicBullets: true,
			dynamicMainBullets: 5
		},
		navigation: {
			prevEl: '.swiper-button-prev',
			nextEl: '.swiper-button-next',
			clickable: true
		}
		// breakpoints: {
		//   0: {

		//     pagination: {
		//       el: '.swiper-pagination',
		//       type: 'bullets',
		//       clickable: true
		//     }
		//   },
		//   768: {
		//     pagination: false
		//   }
		// }
	});

	const cardTogglersMobile = teamSlider.querySelectorAll('.team__item-rotator');
	cardTogglersMobile.forEach(btn => {
		btn.addEventListener('click', function() {
			this.classList.toggle('mobile-active');
		});
	});
}

const awardsSlider = document.querySelector('.awards-swiper');
if (awardsSlider) {
	const awardsSwiper = new Swiper(awardsSlider, {
		slidesPerView: 'auto',
		loop: false,
		slideToClickedSlide: true,
		draggable: true,
		pagination: {
			el: '.swiper-pagination',
			type: 'bullets',
			clickable: true,
			dynamicBullets: true,
			dynamicMainBullets: 5
		},
		navigation: {
			prevEl: '.swiper-button-prev',
			nextEl: '.swiper-button-next',
			clickable: true
		},
	});
}

const companyInfo = document.querySelector('.company-info');
if (companyInfo) {
	const companyCirclesSwiper = new Swiper('.company-circles-swiper', {
		slidesPerView: 'auto',
		loop: false,
		slideToClickedSlide: true,
		draggable: true
	});

	const companySectionsSwiper = new Swiper('.company-sections-swiper', {
		slidesPerView: 'auto',
		loop: false,
		slideToClickedSlide: true,
		draggable: true,
		breakpoints: {
			0: {
			pagination: {
				el: '.swiper-pagination',
				type: 'bullets',
				clickable: true,
				dynamicBullets: true,
				dynamicMainBullets: 5
			}
			},
			768: {
			pagination: false
			}
		}
	});
}

const chronologyBlock = document.querySelector('.chronology');
if (chronologyBlock) {
	const chronologySwiper = new Swiper('.chronology-swiper', {
		slidesPerView: 'auto',
		loop: false,
		slideToClickedSlide: true,
		draggable: true
	});

	// const chronologySwiperText = new Swiper('.chronology-swiper-text', {
	//   slidesPerView: 'auto',
	//   loop: false,
	//   slideToClickedSlide: true,
	//   draggable: true
	// });

	// const chronologySwiperYears = new Swiper('.chronology-swiper-years', {
	//   slidesPerView: 'auto',
	//   loop: false,
	//   slideToClickedSlide: true,
	//   draggable: true,
	// });

	// chronologySwiperText.controller.control = chronologySwiperYears;
	// chronologySwiperYears.controller.control = chronologySwiperText;
}


const requestPayment = document.querySelector('.info-text__payment-request');
if(requestPayment) {
	const paymentDaySwiper = new Swiper('.payment-request-day-swiper', {
		slidesPerView: 'auto',
		loop: false,
		slideToClickedSlide: true,
		draggable: true,
		navigation: {
			prevEl: '#prev-day-btn',
			nextEl: '#next-day-btn',
		}
	});
	const paymentTimeSwiper = new Swiper('.payment-request-time-swiper', {
		slidesPerView: 'auto',
		loop: false,
		slideToClickedSlide: true,
		draggable: true,
		navigation: {
			prevEl: '#prev-time-btn',
			nextEl: '#next-time-btn',
		}
	});
}

// thanks popups
	const thanksPopups = document.querySelectorAll('.modal-thanks');

	[...thanksPopups].map( popup => {
		popup.addEventListener('shown.bs.modal', function () {
		let countdownBtnVal = popup.querySelector('.countdown span');
		let countdownTime = 5;
		countdownBtnVal.innerHTML = countdownTime;

		let buttonCountdownFunc = setInterval( function() {

			if(countdownTime <= 0) {
				clearInterval(buttonCountdownFunc);
				countdownBtnVal.innerHTML = 0;
			} else {
				countdownBtnVal.innerHTML = countdownTime;
			}
			countdownTime -= 1;

		}, 1000);

		// buttonCountdownFunc();
		setTimeout( function() {
			let modal = bootstrap.Modal.getInstance(popup);
			modal.hide();
		}, (countdownTime + 1)*1000);
		});
	});
// end thanks popups

// block video
	const videoBlock = document.querySelector('.livecam');

	function youtube_parser(url) {
		var regExp = /^https?\:\/\/(?:www\.youtube(?:\-nocookie)?\.com\/|m\.youtube\.com\/|youtube\.com\/)?(?:ytscreeningroom\?vi?=|youtu\.be\/|vi?\/|user\/.+\/u\/\w{1,2}\/|embed\/|watch\?(?:.*\&)?vi?=|\&vi?=|\?(?:.*\&)?vi?=)([^#\&\?\n\/<>"']*)/i;
		var match = url.match(regExp);
		console.log(match);
		return (match && match[1].length==11)? match[1] : false;
	}

	function vimeo_parser(url) {
		var regExp = /^(https?:\/\/)?(www.)?(player.)?vimeo.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*$/i;
		var match = url.match(regExp);
		console.log(match);
		return (match && match[5])? match[5] : false;
	}

	function setAttributes(el, attrs) {
		Object.keys(attrs).forEach(key => el.setAttribute(key, attrs[key]));
	}

	if (videoBlock) {
		const modalVideo = document.querySelector('.modal-video');
		if (modalVideo) {
			const videoFrame = modalVideo.querySelector('iframe');

			const videoBtn = videoBlock.querySelector('.livecam__control');
			if (videoBtn) {
				const videoUrl = videoBtn.getAttribute('href');

				videoBtn.addEventListener('click', function() {
					if ( youtube_parser(videoUrl) ) {
						// console.log('video is youtube');
						setAttributes(videoFrame, {
							src: `https://www.youtube.com/embed/${youtube_parser(videoUrl)}`,
							title: "YouTube video player",
							frameborder: "0",
							allow: "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture",
							allowfullscreen: 'true'
						})
					};

					if ( vimeo_parser(videoUrl) ) {
						// console.log('video is vimeo');
						setAttributes(videoFrame, {
							src: `https://player.vimeo.com/video/${vimeo_parser(videoUrl)}`,
							frameborder: "0",
							allow: "autoplay; fullscreen; picture-in-picture",
							allowfullscreen: 'true'
						});
					}
				});

			}

			modalVideo.addEventListener('hidden.bs.modal', function () {
				setAttributes(videoFrame, {
					src: ''
				});
			});
		}
	}
// end block video

// smooth scroll to anchors
	document.querySelectorAll('a[href^="#"]').forEach(anchor => {
		anchor.addEventListener('click', function (e) {
			e.preventDefault();

			document.querySelector(this.getAttribute('href')).scrollIntoView({
				behavior: 'smooth'
			});
		});
	});
// end smooth scroll to anchors

// only numbers inside input
	function setInputFilter(textbox, inputFilter) {
		["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
			textbox.addEventListener(event, function() {
			if (inputFilter(this.value)) {
				this.oldValue = this.value;
				this.oldSelectionStart = this.selectionStart;
				this.oldSelectionEnd = this.selectionEnd;
			} else if (this.hasOwnProperty("oldValue")) {
				this.value = this.oldValue;
				this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
			} else {
				this.value = "";
			}
			});
		});
	}
// end only numbers inside input

// widget iframe height toggle
	const widget = document.querySelector('.widget');
	const frame = document.getElementById('widget-frame');

	const waitCond = (cond, timeout, abortCount) => {
		let count = 0;
		return new Promise((resolve) => {
			const f = () => setTimeout(() => {
				if (cond())
					resolve();
				else if (!abortCount || count < abortCount) {
				f();
					++count;
				}
			}, timeout); // check status every {timeout} seconds

			f();
		});
	};

	if (widget) {
		document.querySelector('.header').classList.add('white-bg');

		if ( ! document.body.classList.contains('inner-page') ) {
			frame.addEventListener("load", () => {
				const startBtnOne = frame.contentWindow.document.getElementById('btn-open-widget');
				const startBtnTwo = frame.contentWindow.document.getElementById('btn-close-widget');

				function toggleWidgetHeight() {
					widget.classList.toggle('fullscreen');
				}

				startBtnOne.addEventListener('click', () => toggleWidgetHeight());
				startBtnTwo.addEventListener('click', () => toggleWidgetHeight());
			});

			// setTimeout(async () => {
			// 	// const widgetInitialButtons = frame.contentWindow.document.querySelectorAll('.ant-btn');
			// 	// console.log(widgetInitialButtons);
			// 	// widgetInitialButtons.forEach( btn => {
			// 	//   btn.addEventListener('click', () => {
			// 	//     widget.classList.add('fullscreen');
			// 	//   });
			// 	// });
			// 	let startBtnOne;
			// 	let startBtnTwo;

			// 	await waitCond(() => {
			// 		startBtnOne = frame.contentWindow.document.getElementById('btn-open-widget');
			// 		startBtnTwo = frame.contentWindow.document.getElementById('btn-close-widget');
			// 		console.log(startBtnOne, startBtnTwo);

			// 		return startBtnOne && startBtnTwo;
			// 	}, 400, 10); // check every 400ms if buttons are available, stop after 10 tries (4s)

			// 	function toggleWidgetHeight() {
			// 		widget.classList.toggle('fullscreen');
			// 	}

			// 	startBtnOne.addEventListener('click', () => toggleWidgetHeight());
			// 	startBtnTwo.addEventListener('click', () => toggleWidgetHeight());
			// }, 0);
		}

	}
// end widget iframe height toggle

// widget faq click
	if (widget && document.body.classList.contains('inner-page') ) {
		const widgetSeo = document.querySelector('.seo');

		document.body.setAttribute("style", "height: 100vh; overflow: hidden;" );
		widgetSeo.setAttribute('style', 'display: none;');
		document.querySelector('footer').setAttribute('style', 'display: none;');

		// setTimeout(async function() {
		frame.addEventListener("load", async () => {
			// check every 400ms if button available, stop after 10 tries (4s)
			await waitCond(() => !!frame.contentWindow.document.getElementById('widget-faq'), 400, 10);

			frame.contentWindow.document.getElementById('widget-faq').addEventListener('click', () => {
				document.body.removeAttribute('style');
				widgetSeo.removeAttribute('style');
				document.querySelector('footer').removeAttribute('style');

				widgetSeo.scrollIntoView({ behavior: 'smooth' });
				widgetSeo.querySelector('.seo-content').classList.add('is-expanded');
			});
		}, 0);
	}
// end widget faq click

// online payment toggle field
	const onlinePaymentSection = document.querySelector('.online-payment');

	if (onlinePaymentSection) {
		// setInputFilter(document.getElementById('payment-order-number'), function(value) {
		// 	return /^-?\d*$/.test(value);
		// });

		const onlinePaymentPromoToggler = document.querySelector('.online-payment__promo-toggler');
		const onlinePaymentPromoInput = document.querySelector('.online-payment__promo-input');
		const onlinePaymentPromoSubmit = document.querySelector('.online-payment__promo-submit');

		const onlinePaymentTotal = document.querySelector('.online-payment__total');
		const onlinePaymentTotalToggler = document.querySelector('.online-payment__total-toggler');

		onlinePaymentPromoToggler && onlinePaymentPromoToggler.addEventListener('click', function() {
			this.parentElement.classList.add('is-active');
		});

		onlinePaymentPromoInput && onlinePaymentPromoInput.addEventListener('input', function() {
			// console.log(this.value);
			if (this.value === '' ) {
				onlinePaymentPromoSubmit.setAttribute('disabled', true);
			}
			else {
				onlinePaymentPromoSubmit.removeAttribute('disabled');
			}
		});

		onlinePaymentTotalToggler && onlinePaymentTotalToggler.addEventListener('click', function() {
			this.parentElement.classList.toggle('is-expanded');
		});
	}
// end online payment toggle field

// seo block
	const seoBlock = document.querySelector('.seo');
	if (seoBlock) {
		document.querySelector('.seo-toggler').addEventListener('click', function() {
			seoBlock.querySelector('.seo-content').classList.toggle('is-expanded');
		});
	}
// end seo block

// cabinet

const cabinet = document.querySelector('.cabinet');
if (cabinet) {
  const cabinetGroups = document.querySelectorAll('.obj_insurance');
  const cabinetEditableBackground = document.querySelector('.cabinet__personal-overlay');

  document.addEventListener('click', function(e) {
    if ( e.target && e.target.classList.contains('cabinet__personal-create__btn--person') || e.target.classList.contains('cabinet__personal-create__btn--car')|| e.target.classList.contains('cabinet__personal-create__btn--estate') ) {
      let cabinetForm = document.querySelector('#new-person');
      if (e.target.classList.contains('cabinet__personal-create__btn--car')) {
        cabinetForm = document.querySelector('#new-car');
      } else if (e.target.classList.contains('cabinet__personal-create__btn--estate')) {
        cabinetForm = document.querySelector('#new-building');
      }
      cabinetForm.classList.toggle('is-editable');
      cabinetForm.classList.remove('d-none');
      document.body.classList.toggle('is-cabinet-editable');
      cabinetForm.classList.contains('is-expanded') && cabinetForm.classList.remove('is-expanded');

      setTimeout(function () {
        let sectionOffset = 100;
        let groupPosition = cabinetForm.getBoundingClientRect().top;
        let offsetPosition = groupPosition + window.pageYOffset - sectionOffset;

        window.scrollTo({
          top: offsetPosition,
          behavior: 'smooth'
        });
      }, 500);
    }
  });
   if (cabinetEditableBackground) {
     cabinetEditableBackground.addEventListener('click', function() {
       [...cabinetGroups].map( group => {
         document.body.classList.remove('is-cabinet-editable');
         group.classList.add('d-none');
         group.classList.contains('is-expanded') && group.classList.remove('is-expanded');
         group.classList.contains('is-editable') && group.classList.remove('is-editable');
       })
     });
   }
}

if (cabinet) {
		const cabinetGroups = document.querySelectorAll('.cabinet__personal-item');
		const cabinetEditableBackground = document.querySelector('.cabinet__personal-overlay');

		document.addEventListener('click', function(e) {
			if ( e.target && e.target.classList.contains('cabinet__personal-item__edit') ) {
				let parent = e.target.parentNode.parentElement.parentElement;

				if (e.target.parentNode.parentElement.classList.contains('cabinet__personal-item')) {
					parent = e.target.parentNode.parentElement
				}

				parent.classList.toggle('is-editable');
				document.body.classList.toggle('is-cabinet-editable');
				parent.classList.contains('is-expanded') && parent.classList.remove('is-expanded');

				setTimeout(function () {
					let sectionOffset = 100;
					let groupPosition = parent.getBoundingClientRect().top;
					let offsetPosition = groupPosition + window.pageYOffset - sectionOffset;

					window.scrollTo({
						top: offsetPosition,
						behavior: 'smooth'
					});
				}, 500);
			}
		});

		[...cabinetGroups].map( group => {

			if (group.querySelector('.cabinet__personal-item__edit') ) {
				const groupEdit = group.querySelector('.cabinet__personal-item__edit');
				// const groupSubmit = group.querySelector('.cabinet__personal-item__submit');

				// groupEdit.addEventListener('click', function() {
				// 	group.classList.toggle('is-editable');
				// 	document.body.classList.toggle('is-cabinet-editable');
        //
				// 	group.classList.contains('is-expanded') && group.classList.remove('is-expanded');
        //
				// 	setTimeout(function () {
				// 		let sectionOffset = 100;
				// 		let groupPosition = group.getBoundingClientRect().top;
				// 		let offsetPosition = groupPosition + window.pageYOffset - sectionOffset;
        //
				// 		window.scrollTo({
				// 			top: offsetPosition,
				// 			behavior: 'smooth'
				// 		});
				// 	}, 500);
        //
				// });

			}

			if ( group.querySelector('.cabinet__personal-item__toggler') ) {
				const groupContentToggle = group.querySelector('.cabinet__personal-item__toggler');
				console.log(groupContentToggle);

				groupContentToggle.addEventListener('click', function() {
					group.classList.toggle('is-expanded');
					document.body.classList.toggle('is-cabinet-editable');
				});
			}

			cabinetEditableBackground.addEventListener('click', function() {
				[...cabinetGroups].map( group => {
					document.body.classList.remove('is-cabinet-editable');
					group.classList.contains('is-expanded') && group.classList.remove('is-expanded');
					group.classList.contains('is-editable') && group.classList.remove('is-editable');
				});
			});


		});

		const cabinetPolicySlider = document.querySelector('.cabinet-policy-swiper');
		if(cabinetPolicySlider) {
			const cabinetPolicySwiper = new Swiper(cabinetPolicySlider, {
			slidesPerView: 'auto',
			loop: false,
			slideToClickedSlide: false,
			draggable: true,
			pagination: {
				el: '.swiper-pagination',
				type: 'bullets',
				clickable: false,
				dynamicBullets: true,
				dynamicMainBullets: 5
			},
			navigation: {
				prevEl: '.swiper-button-prev',
				nextEl: '.swiper-button-next',
				clickable: true
			},

			// breakpoints: {
			//   0: {

			//     pagination: {
			//       el: '.swiper-pagination',
			//       type: 'bullets',
			//       clickable: true
			//     }
			//   },
			//   768: {
			//     pagination: false
			//   }
			// }
			});
		}

		const cabinetIssuesSlider = document.querySelector('.cabinet-issues-swiper');
		if(cabinetIssuesSlider) {
			const cabinetIssuesSwiper = new Swiper(cabinetIssuesSlider, {
			slidesPerView: 'auto',
			loop: false,
			slideToClickedSlide: true,
			draggable: true,
			pagination: {
				el: '.swiper-pagination',
				type: 'bullets',
				clickable: true,
				dynamicBullets: true,
				dynamicMainBullets: 5
			},
			navigation: {
				prevEl: '.swiper-button-prev',
				nextEl: '.swiper-button-next',
				clickable: true
			},
			// breakpoints: {
			//   0: {
			//     pagination: {
			//       el: '.swiper-pagination',
			//       type: 'bullets',
			//       clickable: true,
			//       dynamicBullets: true,
			//       dynamicMainBullets: 5
			//     }
			//   },
			//   768: {
			//     pagination: false
			//   }
			// }
			});
		}

		// const cabinetAddOrderNumberInput = document.querySelector('.cabinet__policy-add__input');
		// setInputFilter(cabinetAddOrderNumberInput, function(value) {
		// 	return /^-?\d*$/.test(value);
		// });

		const cabinetGroupTogglers = document.querySelectorAll('.cabinet__group-title--with-toggler');
		if (cabinetGroupTogglers) {
			cabinetGroupTogglers.forEach(btn => {
				btn.addEventListener('click', () => {
					btn.nextElementSibling.classList.toggle('hidden');
				});
			})
		}

		// modal edit insurance item
		const modalInsurance = cabinet.querySelector('.modal-edit-insurance');

		if ( modalInsurance ) {
			const insuranceModalBtn = modalInsurance.querySelectorAll('.modal-edit-insurance__group-btn');
			const insuranceModalPauseBtn = modalInsurance.querySelector('.modal-edit-insurance__group-btn--pause');
			const insuranceModalRenewBtn = modalInsurance.querySelector('.modal-edit-insurance__group-btn--renew');
			const insuranceModalCancelBtn = modalInsurance.querySelector('.modal-edit-insurance__group-btn--cancel');

			const insuranceDateInput = modalInsurance.querySelectorAll('.modal-edit-insurance__group-input');

			insuranceModalBtn.forEach(btn => {
				btn.addEventListener('click', function() {
					insuranceModalBtn.forEach( btn => btn.parentElement.classList.remove('active') );
					this.parentElement.classList.add('active');
				});
			});

			insuranceDateInput.forEach( input => {
				input.addEventListener('focus', function() {
					this.setAttribute('type', 'date');
				});
				input.addEventListener('blur', function() {
					this.setAttribute('type', 'text');
				});
			})

		}

	}
// end cabinet

// blocks animation
	let wow = new WOW({
		boxClass:     'wow',
		animateClass: 'animate__animated',
		offset:       0,
		mobile:       true,
		live:         true,
		callback:     function(box) {
		},
		scrollContainer: null
	});
	wow.init();
// end blocks animation

// success payment email field
const successPaymentSection = document.querySelector('.success-payment');

if (successPaymentSection) {
	// setInputFilter(document.getElementById('success-payment-email'), function(value) {
	//   return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value);
	// });

	const successPaymentPromoInput = document.querySelector('.success-payment__mailsend-input');
	const successPaymentPromoSubmit = document.querySelector('.success-payment__mailsend-submit');

	successPaymentPromoInput.addEventListener('input', function() {
	// console.log(this.value);
	if (this.value === '' ) {
		successPaymentPromoSubmit.setAttribute('disabled', true);
	}
	else {
		successPaymentPromoSubmit.removeAttribute('disabled');
	}
	});
}

// partners
const blockPartners = document.querySelector('.partners');
	if (blockPartners) {
		const swiperPills = new Swiper('.swiper-pills', {
			slidesPerView: 'auto',
			loop: false,
			slideToClickedSlide: true,
			speed: 1000,
			keyboard: {
				enabled: true,
				onlyInViewport: true
			},
			navigation: {
				prevEl: '.swiper-button-prev',
				nextEl: '.swiper-button-next',
				clickable: true
			}
		});
	}
// end partners

// cart
	const cart = document.querySelector('.cart');
	if (cart) {
		document.querySelector('.header').classList.add('header--with-cart');

		const cartProducts = cart.querySelectorAll('.cart__product');
		const removeModal = cart.querySelector('.cart__modal-remove');
		const cartTogglerMobile = cart.querySelector('.cart__toggler-mobile');

		cartProducts.forEach( (product, index) => {
			const productTitle = product.querySelector('.cart__product-title');
			const productRemove = product.querySelector('.cart__product-remove');

			const productIndex = index;
			let productOpenState = false;

			productTitle.addEventListener('click', function(e) {

				// console.log(productIndex, productOpenState);

				cartProducts.forEach( (product, index) => {
					if (index === productIndex) return;
					product.classList.remove('open');
				});


				if ( product.classList.contains('open') ) {
					product.classList.remove('open');
					cart.classList.remove('open');
				} else {
					product.classList.add('open');
					cart.classList.add('open');
				}
			});

			productRemove.addEventListener('click', function() {
				console.log('cart product remove');
			});

		});

		cartTogglerMobile.addEventListener('click', function() {
			cart.classList.toggle('open-mobile');
		});

		document.addEventListener('click', function(event) {
			// console.log( event.target == cart || cart.contains(event.target) );
			if ( event.target != cart && !cart.contains(event.target) && cart.classList.contains('open') ) {
				cart.classList.remove('open');

				cartProducts.forEach( (product, index) => {
					product.classList.remove('open');
				});
			}
		});
	}
// end cart

// inputs mask
let $phoneInput = $('input[type="phone"]');
// let $mailInput = $('input[type="email"]');

// if ( $mailInput ) {
//   if ($mailInput[0]) {
//     let cursor = $mailInput[0].selectionStart;
//   }
//   let prev = $mailInput.val();
// }

$phoneInput && $phoneInput.inputmask({
	mask: "+38 (099) 999 99 99",
	greedy: false,
	clearMaskOnLostFocus: false
});

// $mailInput && $mailInput.inputmask({
//   mask: "*{1,50}[.*{1,50}][.*{1,50}]@*{1,50}.*{1,20}[.*{1,20}][.*{1,20}]",
//   greedy: false,
//   clearIncomplete: true,
//   showMaskOnHover: false,
//   definitions: {
//     '*': {
//       validator: "[^_@.]"
//     }
//   }
// }).on('keyup paste', function() {
//   // if (this.value && /[^_a-zA-Z0-9@\-.]/i.test(this.value)) {
//   if (this.value && /[^_a-zA-Z0-9@\-.]/i.test(this.value)) {
//     this.value = prev;
//     this.setSelectionRange(cursor, cursor);
//     $mailInput.trigger('input');
//   } else {
//     cursor = this.selectionStart;
//     prev = this.value;
//   }
// });
// end input mask

// info pages financial stats
if ( document.querySelector('.info-text__stats') ) {
	const dropdowns = document.querySelectorAll('.info-text__stats-item.dropdown');
	// console.log(dropdowns);
	dropdowns.forEach( dropdown => {
		dropdown.querySelector('.info-text__stats-item__title').addEventListener('click', function() {
			dropdown.classList.toggle('active');
		});
	});
}

$(function() {
	$('[tab-id]').on('click', function(e) {
		let id = $(this).attr('tab-id');
		e.stopPropagation();

		$(this).siblings().removeClass('active');
		$(this).toggleClass('active');

		$('.info-text__tab').removeClass('active');

		$(`.info-text__tab#tab-${id}`).addClass('active');
	});

	// $('li.has-children').on('click', function(e) {
	//     e.stopPropagation();
	//     $(this).siblings().removeClass('active');
	//     $(this).toggleClass('active');
	// });

});
// info pages financial stats

// footer ask form
const footerForm = document.querySelector('.footer__search__form');
if (footerForm) {
	const askInput = footerForm.querySelector('.ask-input');
	const mailInput = footerForm.querySelector('.mail-input');
	const submitBtn = footerForm.querySelector('.footer-form-submit');

	submitBtn.addEventListener('click', function(event) {
		if ( askInput.value.length && mailInput.classList.contains('hidden') ) {
			event.preventDefault();
			askInput.classList.add('hidden');
			mailInput.classList.remove('hidden');
			submitBtn.setAttribute('type', 'submit');
		}
	});

}
// footer ask form

// search results products
const searchProductsSliders = document.querySelectorAll('.search-results__group-slider');
if(searchProductsSliders) {
	searchProductsSliders.forEach(slider => {

		const swiper = slider.querySelector('.js-search-products-swiper');
		new Swiper(swiper, {
			slidesPerView: 'auto',
			loop: false,
			slideToClickedSlide: false,
			draggable: true,
			pagination: {
				el: '.swiper-pagination',
				type: 'bullets',
				clickable: true,
				dynamicBullets: true,
				dynamicMainBullets: 5
			},
			navigation: {
				prevEl: '.swiper-button-prev',
				nextEl: '.swiper-button-next',
				clickable: true
			},
		});
	});
}
// search results products


// article share
const shareBlock = document.querySelector('.share-block');
if ( shareBlock ) {
	const shareBlockOpener = document.querySelector('.share-article-socials-opener');
	const copyUrlBtn = document.querySelector('.copy-article-link-btn');

	shareBlockOpener.addEventListener('click', () => {
		if (navigator.share) {
			navigator.share({
				// title: 'WebShare API Demo',
				// text: 'text',
				url: window.location.href
			})
			.catch(console.error);
		} else {
			shareBlock.classList.add('active');
		}
	});

	copyUrlBtn.addEventListener('click', function() {
		this.classList.add('copied');
		navigator.clipboard.writeText(window.location.href);

		setTimeout(() => {
			this.classList.remove('copied');
		}, 3000);
	})
}
// article share

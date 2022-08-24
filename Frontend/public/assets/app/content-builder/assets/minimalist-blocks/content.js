/* v3.1 */
function _tabs(n) {
    var html = '';
    for (var i = 1; i <= n; i++) {
        html += '\t';
    }
    return '\n' + html;
}

// source: https: //stackoverflow.com/questions/2255689/how-to-get-the-file-path-of-the-currently-executing-javascript-code
function _path() {
    var scripts = document.querySelectorAll('script[src]');
    var currentScript = scripts[scripts.length - 1].src;
    var currentScriptChunks = currentScript.split('/');
    var currentScriptFile = currentScriptChunks[currentScriptChunks.length - 1];
    return currentScript.replace(currentScriptFile, '');
}
var _snippets_path = _path();

var data_basic = {
    'snippets': []

};

if(!(window.Glide||parent.Glide)){
    for (let i = 0; i < data_basic.snippets.length; i++) {
        if (data_basic.snippets[i].glide) {
            data_basic.snippets.splice(i, 1);
            break;
        }
    }
}

// function itemTitle() {
// 	return myVar = setTimeout(function() {
// 		for (let i = 0; i < data_basic.snippets.length; i++) {
// 			$('.snippet-item').each(function(i, elem) {
// 				$(elem).attr("title", data_basic.snippets[i]['title']);
// 			})
// 		}
// 	}, 7000);
// }
// itemTitle();

// function itemTitle() {
// 	const snippetItems = document.querySelectorAll('.snippet-item');
// 	console.log(snippetItems);
// 	return addTitleAttr = setTimeout(function() {
// 		[...snippetItems].map( (i, elem) => {
// 			elem.setAttribute('title', data_basic.snippets[i]['title']);
// 			console.log(elem);
// 		});

// 	}, 7000);
// }
// itemTitle();

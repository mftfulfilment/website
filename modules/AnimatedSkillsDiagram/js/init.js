
var diagramElement = {
	init: function(){
		this.diagram();
	},
	random: function(l, u){
		return Math.floor((Math.random()*(u-l+1))+l);
	},
	diagram: function(){

		var t = jQuery('.cg__diagram'),
			sizeW = parseInt(t.attr('data-width')) || 400,
			sizeH = sizeW,
			maincolor = t.attr('data-maincolor') || '#193340',
			maintext = t.attr('data-maintext') || '',
			fontsize = t.attr('data-fontsize') || '11px',
			textcolor = t.attr('data-textcolor') || '#fff',
			distance = t.attr('data-distance') || 5;

		var extra = sizeW * 0.07,
			extrHalf = extra/2;

		var diagramWidth = sizeW + extra,
			diagramHeight = sizeH + extra,
			halfW = sizeW/2,
			halfH = sizeH/2,
			mainrad = halfW*0.4;

		var r = Raphael(t[0], diagramWidth, diagramHeight),
			rad = mainrad - 7,
			defaultText = maintext,
			speed = 250;

		// try to make it responsive
		r.canvas.setAttribute('preserveAspectRatio', 'xMinYMin meet');
		r.canvas.setAttribute('viewBox', '0 0 ' + diagramWidth +' '+ diagramHeight);
		// r.canvas.removeAttribute('width');
		// r.canvas.removeAttribute('height');

		// Start Drawing
		r.circle( (halfW + extrHalf), (halfH + extrHalf), mainrad).attr({ stroke: 'none', fill: maincolor });

		var title = r.text( (halfW + extrHalf), (halfH + extrHalf) , defaultText).attr({
			font: fontsize,
			fill: textcolor
		}).toFront();

		r.customAttributes.arc = function(value, color, rad){
			var v = 3.6*value,
			alpha = v == 360 ? 359.99 : v,
			random = diagramElement.random(91, 240),
			a = (random-alpha) * Math.PI/180,
			b = random * Math.PI/180,
			sx = (halfW + extrHalf) + rad * Math.cos(b),
			sy = (halfH + extrHalf) - rad * Math.sin(b),
			x = (halfW + extrHalf) + rad * Math.cos(a),
			y = (halfH + extrHalf) - rad * Math.sin(a),
			path = [['M', sx, sy], ['A', rad, rad, 0, +(alpha > 180), 1, x, y]];
			return { path: path, stroke: color };
		};

		var skill_list = jQuery('.skills_list li'),
			skill_list_count = skill_list.length;

		skill_list.each(function(i){
			var t = jQuery(this),
			color = t.css('background-color'),
			value = t.attr('data-percent'),
			count = t.attr('data-count'),
			text = t.text(),
			rest = halfW*0.6,
			defStrokeWid = (rest / skill_list_count) - distance; // minus 5px distance

			rad += rest / skill_list_count;

			console.log(rest);
			console.log(skill_list_count);
			console.log(distance);

			var z = r.path().attr({ arc: [value, color, rad], 'stroke-width': defStrokeWid });

			z.mouseover(function(){
				this.animate({ 'stroke-width': defStrokeWid*2 , opacity: 0.75 }, 1000, 'elastic');
					if(Raphael.type != 'VML') //solves IE problem
					this.toFront();
					title.stop().animate({ opacity: 0 }, speed, '>', function(){
						this.attr({ text: text + '\n' + count  }).animate({ opacity: 1 }, speed, '<');
					});
				}).mouseout(function(){
					this.stop().animate({ 'stroke-width': defStrokeWid, opacity: 1 }, speed*4, 'elastic');
					title.stop().animate({ opacity: 0 }, speed, '>', function(){
						title.attr({ text: defaultText }).animate({ opacity: 1 }, speed, '<');
					});
				});
		});
	}
};

$(function(){ diagramElement.init(); });

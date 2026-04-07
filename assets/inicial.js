let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++){
    arrow[i].addEventListener("click", (e) => {
        let arrowParent = e.target.parentElement.parentElement;
        arrowParent.classList.toggle("showMenu");
    });
}

/* ── Helpers de breakpoint ── */
function isMobile()  { return window.innerWidth <= 767; }
function isTablet()  { return window.innerWidth > 767 && window.innerWidth <= 1024; }
function isDesktop() { return window.innerWidth > 1024; }

/* ── Elementos ── */
const taskbar        = document.querySelector('.right-taskbar');
const menuBtn        = document.querySelector('.bx-menu');
const sidebarOverlay = document.getElementById('sidebarOverlay');

/* ── Limpa todas as classes de estado da sidebar ── */
function resetSidebarClasses() {
    taskbar.classList.remove('close', 'open');
    sidebarOverlay.classList.remove('active');
}

/* ── Aplica o estado correto para o breakpoint atual ── */
function applySidebarForBreakpoint() {
    if (isMobile()) {
        /* No mobile a sidebar é uma bottom nav — sem classes de estado */
        resetSidebarClasses();
    } else if (isTablet()) {
        /* No tablet começa fechada (sem classe = colapsada em 78px) */
        taskbar.classList.remove('close', 'open');
        sidebarOverlay.classList.remove('active');
    } else {
        /* Desktop: começa aberta (sem close) */
        taskbar.classList.remove('close', 'open');
        sidebarOverlay.classList.remove('active');
    }
}

/* ── Clique no botão menu ── */
menuBtn.addEventListener('click', () => {
    if (isMobile()) return; /* No mobile o botão não faz nada */

    if (isTablet()) {
        const opening = !taskbar.classList.contains('open');
        taskbar.classList.toggle('open', opening);
        taskbar.classList.remove('close');
        sidebarOverlay.classList.toggle('active', opening);
        return;
    }

    /* Desktop: alterna close */
    taskbar.classList.toggle('close');
    taskbar.classList.remove('open');
    sidebarOverlay.classList.remove('active');
});

/* ── Fecha ao clicar no overlay ── */
sidebarOverlay.addEventListener('click', () => {
    taskbar.classList.remove('open');
    sidebarOverlay.classList.remove('active');
});

/* ── Ajusta ao redimensionar ── */
let lastBreakpoint = null;

window.addEventListener('resize', () => {
    const current = isMobile() ? 'mobile' : isTablet() ? 'tablet' : 'desktop';

    /* Só reseta se mudou de breakpoint, evita resetar durante scroll/resize leve */
    if (current !== lastBreakpoint) {
        lastBreakpoint = current;
        applySidebarForBreakpoint();
    }
});

/* ── Estado inicial ── */
lastBreakpoint = isMobile() ? 'mobile' : isTablet() ? 'tablet' : 'desktop';
applySidebarForBreakpoint();


/* ══════════════════════════════════════════
   Dial / Progress chart
══════════════════════════════════════════ */
var Dial = function(container) {
    this.container   = container;
    this.size        = this.container.dataset.size;
    this.strokeWidth = this.size / 8;
    this.radius      = (this.size / 2) - (this.strokeWidth / 2);
    this.value       = this.container.dataset.value;
    this.direction   = this.container.dataset.arrow;
    this.svg;
    this.defs;
    this.slice;
    this.dialOverlay;
    this.text;
    this.arrow;
    this.create();
};
Dial.prototype.create = function() {
    this.createSvg();
    this.createDefs();
    this.createSlice();
    this.createOverlay();
    this.createText();
    this.createArrow();
    this.container.appendChild(this.svg);
};
Dial.prototype.createSvg = function() {
    var svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    svg.setAttribute('width',  this.size + 'px');
    svg.setAttribute('height', this.size + 'px');
    this.svg = svg;
};

Dial.prototype.createDefs = function() {
    var defs = document.createElementNS("http://www.w3.org/2000/svg", "defs");

    var linearGradient = document.createElementNS("http://www.w3.org/2000/svg", "linearGradient");
    linearGradient.setAttribute('id', 'gradient');
    var stop1 = document.createElementNS("http://www.w3.org/2000/svg", "stop");
    stop1.setAttribute('stop-color', '#6E4AE2');
    stop1.setAttribute('offset', '0%');
    linearGradient.appendChild(stop1);
    var stop2 = document.createElementNS("http://www.w3.org/2000/svg", "stop");
    stop2.setAttribute('stop-color', '#78F8EC');
    stop2.setAttribute('offset', '100%');
    linearGradient.appendChild(stop2);
    var linearGradientBackground = document.createElementNS("http://www.w3.org/2000/svg", "linearGradient");
    linearGradientBackground.setAttribute('id', 'gradient-background');
    var stop1b = document.createElementNS("http://www.w3.org/2000/svg", "stop");
    stop1b.setAttribute('stop-color', 'rgba(0,0,0,0.2)');
    stop1b.setAttribute('offset', '0%');
    linearGradientBackground.appendChild(stop1b);
    var stop2b = document.createElementNS("http://www.w3.org/2000/svg", "stop");
    stop2b.setAttribute('stop-color', 'rgba(0,0,0,0.05)');
    stop2b.setAttribute('offset', '100%');
    linearGradientBackground.appendChild(stop2b);
    defs.appendChild(linearGradient);
    defs.appendChild(linearGradientBackground);
    this.svg.appendChild(defs);
    this.defs = defs;
};

Dial.prototype.createSlice = function() {
    var track = document.createElementNS("http://www.w3.org/2000/svg", "circle");
    track.setAttribute('cx', this.size / 2);
    track.setAttribute('cy', this.size / 2);
    track.setAttribute('r',  this.radius);
    track.setAttribute('fill',   'none');
    track.setAttribute('stroke', 'url(#gradient-background)');
    track.setAttribute('stroke-width', this.strokeWidth);
    this.svg.appendChild(track);
    var slice = document.createElementNS("http://www.w3.org/2000/svg", "path");
    slice.setAttribute('fill',         'none');
    slice.setAttribute('stroke',       'url(#gradient)');
    slice.setAttribute('stroke-width', this.strokeWidth);
    slice.setAttribute('stroke-linecap', 'round');
    slice.setAttribute('transform',
        'translate(' + this.strokeWidth / 2 + ',' + this.strokeWidth / 2 + ')');
    slice.setAttribute('class', 'animate-draw');
    this.svg.appendChild(slice);
    this.slice = slice;
};
Dial.prototype.createOverlay = function() {
    var r   = this.radius - this.strokeWidth / 2;
    var cx  = this.size / 2;
    var cy  = this.size / 2;
    var overlay = document.createElementNS("http://www.w3.org/2000/svg", "circle");
    overlay.setAttribute('cx',   cx);
    overlay.setAttribute('cy',   cy);
    overlay.setAttribute('r',    r);
    overlay.setAttribute('fill', 'url(#gradient-background)');
    this.svg.appendChild(overlay);
    this.dialOverlay = overlay;
};
Dial.prototype.createText = function() {
    var text = document.createElementNS("http://www.w3.org/2000/svg", "text");
    text.setAttribute('x',              this.size / 2);
    text.setAttribute('y',              this.size / 2 + 10);
    text.setAttribute('text-anchor',    'middle');
    text.setAttribute('fill',           '#f5f5f5');
    text.setAttribute('font-size',      this.size / 3.5);
    text.setAttribute('font-family',    'Montserrat, sans-serif');
    text.setAttribute('font-weight',    '600');
    this.svg.appendChild(text);
    this.text = text;
};
Dial.prototype.createArrow = function() {
    var arrowSize = this.size / 8;
    var cx = this.size / 2;
    var cy = this.size / 2 + this.size / 5;
    var arrow = document.createElementNS("http://www.w3.org/2000/svg", "text");
    arrow.setAttribute('x',           cx);
    arrow.setAttribute('y',           cy);
    arrow.setAttribute('text-anchor', 'middle');
    arrow.setAttribute('font-size',   arrowSize);
    arrow.setAttribute('fill',        this.direction === 'up' ? '#78F8EC' : '#E24B4A');
    arrow.textContent = this.direction === 'up' ? '▲' : '▼';
    this.svg.appendChild(arrow);
    this.arrow = arrow;
};
Dial.prototype.polarToCartesian = function(cx, cy, r, angleDeg) {
    var rad = (angleDeg - 90) * Math.PI / 180.0;
    return {
        x: cx + r * Math.cos(rad),
        y: cy + r * Math.sin(rad)
    };
};

Dial.prototype.describeArc = function(cx, cy, r, startAngle, endAngle) {
    var start    = this.polarToCartesian(cx, cy, r, endAngle);
    var end      = this.polarToCartesian(cx, cy, r, startAngle);
    var largeArc = endAngle - startAngle <= 180 ? '0' : '1';
    return [
        'M', start.x, start.y,
        'A', r, r, 0, largeArc, 0, end.x, end.y
    ].join(' ');
};
Dial.prototype.setValue = function(value) {
    var c = (value / 100) * 360;
    if (c === 360) c = 359.99;
    var xy = this.size / 2 - this.strokeWidth / 2;
    var d  = this.describeArc(xy, xy, xy, 180, 180 + c);
    this.slice.setAttribute('d', d);
    var tspanSize = (this.size / 3.5) / 3;
    this.text.innerHTML =
        Math.floor(value) +
        '<tspan font-size="' + tspanSize + '" dy="' + (-tspanSize * 1.2) + '">%</tspan>';
};
Dial.prototype.animateStart = function() {
    var self    = this;
    var target  = parseFloat(this.value);
    var current = 0;
    var step    = target / 60;

    function frame() {
        current += step;
        if (current >= target) {
            self.setValue(target);
            return;
        }
        self.setValue(current);
        requestAnimationFrame(frame);
    }
    requestAnimationFrame(frame);
};

/* ── Inicialização do Dial ── */
var containers = document.getElementsByClassName("chart");
if (containers.length > 0) {
    var dial = new Dial(containers[0]);
    dial.animateStart();
};
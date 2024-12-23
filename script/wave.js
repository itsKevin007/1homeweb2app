function atvImg() {
  var d = document,
    de = d.documentElement,
    bd = d.getElementsByTagName("body")[0],
    htm = d.getElementsByTagName("html")[0],
    win = window,
    imgs = d.querySelectorAll(".atvImg"),
    totalImgs = imgs.length,
    supportsTouch = "ontouchstart" in win || navigator.msMaxTouchPoints;

  if (totalImgs <= 0) {
    return;
  }

  for (var l = 0; l < totalImgs; l++) {
    var thisImg = imgs[l],
      layerElems = thisImg.querySelectorAll(".atvImg-layer"),
      totalLayerElems = layerElems.length;

    if (totalLayerElems <= 0) {
      continue;
    }

    while (thisImg.firstChild) {
      thisImg.removeChild(thisImg.firstChild);
    }

    var containerHTML = d.createElement("div"),
      shineHTML = d.createElement("div"),
      shadowHTML = d.createElement("div"),
      layersHTML = d.createElement("div"),
      layers = [];

    thisImg.id = "atvImg__" + l;
    containerHTML.className = "atvImg-container";
    shineHTML.className = "atvImg-shine";
    shadowHTML.className = "atvImg-shadow";
    layersHTML.className = "atvImg-layers";

    for (var i = 0; i < totalLayerElems; i++) {
      var layer = d.createElement("div"),
        imgSrc = layerElems[i].getAttribute("data-img");

      layer.className = "atvImg-rendered-layer";
      layer.setAttribute("data-layer", i);
      layer.style.backgroundImage = "url(" + imgSrc + ")";
      layersHTML.appendChild(layer);

      layers.push(layer);
    }

    containerHTML.appendChild(shadowHTML);
    containerHTML.appendChild(layersHTML);
    containerHTML.appendChild(shineHTML);
    thisImg.appendChild(containerHTML);

    var w = thisImg.clientWidth || thisImg.offsetWidth || thisImg.scrollWidth;
    thisImg.style.transform = "perspective(" + w * 3 + "px)";

    if (supportsTouch) {
      win.preventScroll = false;

      (function (_thisImg, _layers, _totalLayers, _shine) {
        thisImg.addEventListener("touchmove", function (e) {
          if (win.preventScroll) {
            e.preventDefault();
          }
          processMovement(e, true, _thisImg, _layers, _totalLayers, _shine);
        });
        thisImg.addEventListener("touchstart", function (e) {
          win.preventScroll = true;
          processEnter(e, _thisImg);
        });
        thisImg.addEventListener("touchend", function (e) {
          win.preventScroll = false;
          processExit(e, _thisImg, _layers, _totalLayers, _shine);
        });
      })(thisImg, layers, totalLayerElems, shineHTML);
    } else {
      (function (_thisImg, _layers, _totalLayers, _shine) {
        thisImg.addEventListener("mousemove", function (e) {
          processMovement(e, false, _thisImg, _layers, _totalLayers, _shine);
        });
        thisImg.addEventListener("mouseenter", function (e) {
          processEnter(e, _thisImg);
        });
        thisImg.addEventListener("mouseleave", function (e) {
          processExit(e, _thisImg, _layers, _totalLayers, _shine);
        });
      })(thisImg, layers, totalLayerElems, shineHTML);
    }
  }

  function processMovement(e, touchEnabled, elem, layers, totalLayers, shine) {
    var bdst = bd.scrollTop || htm.scrollTop,
      bdsl = bd.scrollLeft,
      pageX = touchEnabled ? e.touches[0].pageX : e.pageX,
      pageY = touchEnabled ? e.touches[0].pageY : e.pageY,
      offsets = elem.getBoundingClientRect(),
      w = elem.clientWidth || elem.offsetWidth || elem.scrollWidth,
      h = elem.clientHeight || elem.offsetHeight || elem.scrollHeight,
      wMultiple = 320 / w,
      offsetX = 0.52 - (pageX - offsets.left - bdsl) / w,
      offsetY = 0.52 - (pageY - offsets.top - bdst) / h,
      dy = pageY - offsets.top - bdst - h / 2,
      dx = pageX - offsets.left - bdsl - w / 2,
      yRotate = (offsetX - dx) * (0.07 * wMultiple),
      xRotate = (dy - offsetY) * (0.1 * wMultiple),
      imgCSS = "rotateX(" + xRotate + "deg) rotateY(" + yRotate + "deg)",
      arad = Math.atan2(dy, dx),
      angle = (arad * 180) / Math.PI - 90;

    if (angle < 0) {
      angle = angle + 360;
    }

    if (elem.firstChild.className.indexOf(" over") != -1) {
      imgCSS += " scale3d(1.07,1.07,1.07)";
    }
    elem.firstChild.style.transform = imgCSS;

    shine.style.background =
      "linear-gradient(" +
      angle +
      "deg, rgba(255,255,255," +
      ((pageY - offsets.top - bdst) / h) * 0.4 +
      ") 0%,rgba(255,255,255,0) 80%)";
    shine.style.transform =
      "translateX(" +
      offsetX * totalLayers -
      0.1 +
      "px) translateY(" +
      offsetY * totalLayers -
      0.1 +
      "px)";

    var revNum = totalLayers;
    for (var ly = 0; ly < totalLayers; ly++) {
      layers[ly].style.transform =
        "translateX(" +
        offsetX * revNum * ((ly * 2.5) / wMultiple) +
        "px) translateY(" +
        offsetY * totalLayers * ((ly * 2.5) / wMultiple) +
        "px)";
      revNum--;
    }
  }

  function processEnter(e, elem) {
    elem.firstChild.className += " over";
  }

  function processExit(e, elem, layers, totalLayers, shine) {
    var container = elem.firstChild;

    container.className = container.className.replace(" over", "");
    container.style.transform = "";
    shine.style.cssText = "";

    for (var ly = 0; ly < totalLayers; ly++) {
      layers[ly].style.transform = "";
    }
  }
}

atvImg();

// slider

document.querySelectorAll(".slider").forEach((elem) => {
  let handle,
    width = elem.offsetWidth,
    slider = noUiSlider.create(elem, {
      start: 1500,
      connect: "lower",
      range: {
        min: 0,
        max: 2000
      },
      step: 100
    });

  let point = document.createElement("div");
  point.classList.add("point");

  let svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
  svg.setAttribute("viewBox", "0 0 " + width + " 83");
  elem.appendChild(svg);

  let active = document.createElement("div");
  active.classList.add("active");
  active.appendChild(svg.cloneNode(true));

  elem.appendChild(active);

  let value = document.createElement("div");
  value.classList.add("value");

  point.appendChild(value);

  elem.querySelector(".noUi-handle").appendChild(point);

  let svgPath = new Proxy(
    {
      x: null,
      y: null,
      b: null,
      a: null
    },
    {
      set(target, key, value) {
        target[key] = value;
        if (
          target.x !== null &&
          target.y !== null &&
          target.b !== null &&
          target.a !== null
        ) {
          elem.querySelectorAll("svg").forEach((svg) => {
            svg.innerHTML = getPath(
              [target.x, target.y],
              target.b,
              target.a,
              width
            );
          });
        }
        return true;
      },
      get(target, key) {
        return target[key];
      }
    }
  );

  setCSSVars(elem);

  slider.on("start", (e) => {
    handle = elem.querySelector(".noUi-handle");
    elem
      .querySelector(".noUi-handle")
      .querySelector(".value").textContent = Math.round(e);
  });

  slider.on("update", (e) => {
    setCSSVars(elem);
    elem
      .querySelector(".noUi-handle")
      .querySelector(".value").textContent = Math.round(e);
  });

  slider.on("slide", (e) => {
    setCSSVars(elem);
    elem
      .querySelector(".noUi-handle")
      .querySelector(".value").textContent = Math.round(e);
  });

  slider.on("end", (e) => {
    gsap.to(handle, {
      "--y": 0,
      duration: 0.6,
      ease: "elastic.out(1.08, .44)"
    });
    gsap.to(svgPath, {
      y: 42,
      duration: 0.6,
      ease: "elastic.out(1.08, .44)"
    });
    handle = null;
  });

  svgPath.x = width / 2;
  svgPath.y = 42;
  svgPath.b = 0;
  svgPath.a = width;

  let onMove = (e) => {
    if (handle) {
      let laziness = 4,
        max = 24,
        edge = 52,
        currentLeft =
          handle.getBoundingClientRect().left -
          elem.getBoundingClientRect().left,
        handleWidth = handle.offsetWidth,
        handleHalf = handleWidth / 2,
        y =
          e.clientY -
          handle.getBoundingClientRect().top -
          handle.offsetHeight / 2,
        moveY =
          y - laziness >= 0
            ? y - laziness
            : y + laziness <= 0
            ? y + laziness
            : 0,
        modify = 1;

      moveY = moveY > max ? max : moveY < -max ? -max : moveY;
      modify =
        (currentLeft + handleHalf <= edge
          ? (currentLeft + handleHalf) / edge
          : 1) *
        (width - currentLeft - handleWidth <= edge
          ? (width - currentLeft - handleWidth) / edge
          : 1);
      modify = modify > 1 ? 1 : modify < 0 ? 0 : modify;

      svgPath.b = (currentLeft / 2) * modify;
      svgPath.a = width;
      svgPath.x = currentLeft + handleHalf;
      svgPath.y = moveY * modify + 42;

      handle.style.setProperty("--y", moveY * modify);
    }
  };

  document.addEventListener("pointermove", onMove);
});

function getPoint(point, i, a, smoothing) {
  let cp = (current, previous, next, reverse) => {
      let p = previous || current,
        n = next || current,
        o = {
          length: Math.sqrt(
            Math.pow(n[0] - p[0], 2) + Math.pow(n[1] - p[1], 2)
          ),
          angle: Math.atan2(n[1] - p[1], n[0] - p[0])
        },
        angle = o.angle + (reverse ? Math.PI : 0),
        length = o.length * smoothing;
      return [
        current[0] + Math.cos(angle) * length,
        current[1] + Math.sin(angle) * length
      ];
    },
    cps = cp(a[i - 1], a[i - 2], point, false),
    cpe = cp(point, a[i - 1], a[i + 1], true);
  return `C ${cps[0]},${cps[1]} ${cpe[0]},${cpe[1]} ${point[0]},${point[1]}`;
}

function getPath(update, before, after, width) {
  let smoothing = 0.16,
    points = [
      [0, 42],
      [before <= 0 ? 0 : before, 42],
      update,
      [after >= width ? width : after, 42],
      [width, 42]
    ],
    d = points.reduce(
      (acc, point, i, a) =>
        i === 0
          ? `M ${point[0]},${point[1]}`
          : `${acc} ${getPoint(point, i, a, smoothing)}`,
      ""
    );
  return `<path d="${d}" />`;
}

function setCSSVars(slider) {
  let handle = slider.querySelector(".noUi-handle");
  slider.style.setProperty("--slider-width", slider.offsetWidth + "px");
  slider.style.setProperty(
    "--active-width",
    handle.getBoundingClientRect().left -
      slider.getBoundingClientRect().left +
      handle.offsetWidth / 2
  );
}

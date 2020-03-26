/* Element vi arbetar med */
const eCanvas = document.querySelector("canvas");

/* Ställ in bredd och storlek */
eCanvas.width = 800;
eCanvas.height = 600;

/* Starta canvas rityta */
var ctx = eCanvas.getContext("2d");

/* Globala variabler */
var piga = {
    rad: 0,
    kol: 0,
    rot: 0,
    bild: new Image()
}
/* 16 kolumner x 12 rader (varje ruta är 50*50px) */
var karta = [
    [0,  1,  2, 33,  2, 33,  3,  0,  0, 0, 54, 0, 0, 0, 1, 0],
    [0, 21, 13,  0, 55,  0, 56,  0, 54, 0, 55, 0, 1, 0, 1, 0],
    [0,  0, 55,  0, 55,  0,  0,  0, 55, 0, 55, 0, 1, 0, 1, 0],
    [31, 0, 55,  0, 21, 33, 33, 33, 35, 0, 1, 0, 1, 0, 1, 0],
    [0,  0, 56,  0,  0,  0,  0,  0, 55, 0, 0, 0, 1, 0, 1, 0],
    [0, 54, 32, 33, 34,  0,  1, 33, 22, 1, 1, 0, 1, 0, 1, 0],
    [0, 55,  0,  0,  0,  0, 55,  0,  0, 0, 0, 0, 1, 0, 1, 0],
    [0, 55,  0, 32,  3,  0, 55,  0,  1, 1, 1, 0, 1, 0, 1, 0],
    [0, 55,  0,  0, 55,  0, 55,  0,  0, 0, 1, 0, 1, 0, 1, 0],
    [0, 55,  31, 0, 55,  0,  1,  1,  1, 0, 1, 0, 1, 0, 1, 0],
    [0, 56,  0,  0, 55,  0,  0,  0,  0, 0, 1, 0, 1, 0, 0, 0],
    [0,  0,  0,  1,  2,  2,  2,  2,  2, 2, 2, 2, 2, 2, 2, 2]
];

/* Nyckelpigans startläge */
piga.rad = 0;
piga.kol = 0;
piga.bild.src = "./nyckelpiga.png";

/* Ladda in tilesheet */
var tileSheet = new Image();
tileSheet.src = "./tilesheet-swamp.png";

/* Rita ut nyckelpigan */
function ritaPiga() {
    ctx.save();
    ctx.translate(piga.kol * 50 + 25, piga.rad * 50 + 25);
    ctx.rotate(piga.rot);
    ctx.drawImage(piga.bild, -25, -25, 50, 50);
    ctx.restore();
}

/* Rita ut kartan */
function ritaKarta() {
    /* Gå igenom varje rad */
    for (let rad = 0; rad < karta.length; rad++) {
        /* Gå igenom varje kolumn */
        for (let kol = 0; kol < karta[rad].length; kol++) {
            if (karta[rad][kol] != 0) {
                var rest = karta[rad][kol] % 10;
                var rutaPos;
                if (rest == 0) {
                    rutaPos = 10 * 32 - 32;
                } else {
                    rutaPos = rest * 32 - 32;
                }
                var rutaPosRad = Math.ceil(karta[rad][kol] / 10) * 32 - 32;
                ctx.drawImage(tileSheet, rutaPos, rutaPosRad, 32, 32, kol * 50, rad * 50, 50, 50);
            }
        }
    }
}

/* Lyssna på pil-tangenter */
window.addEventListener("keydown", function(e) {
    switch (e.key) {
        case "ArrowRight":
            if (karta[piga.rad][piga.kol + 1] == 0) {
                piga.kol++;
            }
            piga.rot = 90 * (Math.PI / 180);
            break;
        case "ArrowLeft":
            if (karta[piga.rad][piga.kol - 1] == 0) {
                piga.kol--;
            }
            piga.rot = -90 * (Math.PI / 180);
            break;
        case "ArrowDown":
            if (karta[piga.rad + 1][piga.kol] == 0) {
                piga.rad++;
            }
            piga.rot = Math.PI;
            break;
        case "ArrowUp":
            if (karta[piga.rad - 1][piga.kol] == 0) {
                piga.rad--;
            }
            piga.rot = 0;
            break;
    }
});

/* Animationsloopen */
ctx.fillStyle = "#000";
function gameLoop() {
    /* Rensa canvas */
    ctx.clearRect(0, 0, eCanvas.width, eCanvas.height);

    ritaKarta();
    ritaPiga();

    requestAnimationFrame(gameLoop);
}

/* Starta spelet */
gameLoop();
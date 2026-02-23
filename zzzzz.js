    (async function () {
        const selector = "#dexy";
        const targets = ["charmander", "charmeleon", "retro"];
        const notTragets = ["ghostly" , "metallic", "shadow", "dark"]
        const legendary = ".fa-star";
        const sbtn = ".sbtn"

        const pattern = [
            "n","n","n",
            "w","w","w",
            "s","s","s",
            "e","e","e"
        ];

        const dirMap = {
            n: "#move_n",
            w: "#move_w",
            s: "#nmove_s",
            e: "#nmove_e"
        };

        const sleep = ms => new Promise(r => setTimeout(r, ms));
        let i = 0;
        let stopBeep = false;

        // ESC key stops the beep
        document.addEventListener("keydown", e => {
            if (e.key === "Escape") stopBeep = true;
        });

        // Function to play continuous beep
        function startBeep() {
            const ctx = new (window.AudioContext || window.webkitAudioContext)();
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();

            osc.type = "sine";
            osc.frequency.value = 880;
            gain.gain.value = 0.3;

            osc.connect(gain);
            gain.connect(ctx.destination);
            osc.start();

            const interval = setInterval(() => {
                if (stopBeep) {
                    osc.stop();
                    ctx.close();
                    clearInterval(interval);
                    console.log("Beep stopped.");
                }
            }, 100);
        }

        while (true) {
            const target = document.querySelector(selector);
            const legendaryTarget = document.querySelector(legendary);
            const sbtnTarget = document.querySelectorAll(sbtn);

            // Check Pokémon text
            let found = false;
            if (sbtnTarget.length >=2) {
                found = true;
            }
            if (target) {
                const text = target.textContent.trim().toLowerCase();
                if (targets.some(p => text.includes(p))) {
                    if (text === "charmander" || text === "charmeleon" || notTragets.some(p => text.includes(p))) { // Skip if it's one of the targets
                        found = false;
                    } else {
                        found = true;
                    }
                }; // Accept if its shiny or something else is there instead of the targets
            }

            // Check legendary star
            if (legendaryTarget) found = true;

            // If either found, beep and stop movement
            if (found) {
                console.log("Pokemon found!", target ? target.textContent : "Legendary spotted!");
                startBeep();
                break;
            }

            // Move in pattern
            const dir = pattern[i % pattern.length];
            i++;

            const link = document.querySelector(dirMap[dir]);
            if (!link) {
                await sleep(300);
                continue;
            }

            link.click();
            console.log("Moved:", dir);

            await sleep(600);
        }
    })();

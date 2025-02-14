// const autoComplete = require("@tarekraafat/autocomplete.js");
let incomingLetters = JSON.parse(document.getElementById('incomingLettersForJs').value);
let incomingLettersSearchOn = []

for (let i of incomingLetters) {
    incomingLettersSearchOn = incomingLettersSearchOn.concat(Object.values(i));
}

const autoCompleteJS = new autoComplete({
    selector: "#autoComplete",
    placeHolder: "Поиск по параметру",
    data: {
        src: incomingLettersSearchOn,
        cache: true,
    },
    resultsList: {
        element: (list, data) => {
            if (!data.results.length) {
                // Create "No Results" message element
                const message = document.createElement("div");
                // Add class to the created element
                message.setAttribute("class", "no_result");
                // Add message text content
                message.innerHTML = `<span>Found No Results for "${data.query}"</span>`;
                // Append message element to the results list
                list.prepend(message);
            }
        },
        noResults: true,
    },
    resultItem: {
        highlight: true,
    }
});

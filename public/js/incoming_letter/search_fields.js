// const autoComplete = require("@tarekraafat/autocomplete.js");
let document_from_for_js = JSON.parse(document.getElementById('document_from_for_js').value);
let document_name_for_js = JSON.parse(document.getElementById('document_name_for_js').value);
let performer_for_js = JSON.parse(document.getElementById('performer_for_js').value);

let document_from_for_search = [];
let document_name_for_search = [];
let performer_for_search = [];

for (let i of document_from_for_js) {
    document_from_for_search = document_from_for_search.concat(i.organisation_name);
}

for (let i of document_name_for_js) {
    document_name_for_search = document_name_for_search.concat(i.name);
}

for (let i of performer_for_js) {
    performer_for_search = performer_for_search.concat(i.performer_name);
}

const autoCompleteDocumentFrom = new autoComplete({
    selector: "#document_from",
    placeHolder: "Отправитель...",
    data: {
        src: document_from_for_search,
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

document_from.addEventListener("selection", function (event) {
    // "event.detail" carries the autoComplete.js "feedback" object
    document_from.value = event.detail.selection.value;
});

const autoCompleteDocumentName = new autoComplete({
    selector: "#document_name",
    placeHolder: "Наименование документа...",
    data: {
        src: document_name_for_search,
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

document_name.addEventListener("selection", function (event) {
    // "event.detail" carries the autoComplete.js "feedback" object
    document_name.value = event.detail.selection.value;
});


const autoCompletePerformer = new autoComplete({
    selector: "#performer",
    placeHolder: "Ответственный исполнитель...",
    data: {
        src: performer_for_search,
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

performer.addEventListener("selection", function (event) {
    // "event.detail" carries the autoComplete.js "feedback" object
    performer.value = event.detail.selection.value;
});

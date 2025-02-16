// const autoComplete = require("@tarekraafat/autocomplete.js");
let destination_for_js = JSON.parse(document.getElementById('destination_for_js').value);
let document_name_for_js = JSON.parse(document.getElementById('document_name_for_js').value);
let signer_for_js = JSON.parse(document.getElementById('signer_for_js').value);
let performer_for_js = JSON.parse(document.getElementById('performer_for_js').value);

let destination_for_search = [];
let document_name_for_search = [];
let signer_for_search = [];
let performer_for_search = [];

for (let i of destination_for_js) {
    destination_for_search = destination_for_search.concat(i.destination_name);
}

for (let i of document_name_for_js) {
    document_name_for_search = document_name_for_search.concat(i.name);
}

for (let i of signer_for_js) {
    signer_for_search = signer_for_search.concat(i.signer_name);
}

for (let i of performer_for_js) {
    performer_for_search = performer_for_search.concat(i.performer_name);
}

const autoCompleteDestination = new autoComplete({
    selector: "#destination",
    placeHolder: "Получатель...",
    data: {
        src: destination_for_search,
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

destination.addEventListener("selection", function (event) {
    // "event.detail" carries the autoComplete.js "feedback" object
    destination.value = event.detail.selection.value;
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

const autoCompleteSigner = new autoComplete({
    selector: "#signer",
    placeHolder: "Подписант...",
    data: {
        src: signer_for_search,
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

signer.addEventListener("selection", function (event) {
    // "event.detail" carries the autoComplete.js "feedback" object
    signer.value = event.detail.selection.value;
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

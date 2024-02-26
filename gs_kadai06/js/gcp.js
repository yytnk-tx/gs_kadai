const gcpConfigFilePath = "../settings/gcpConfig.json";
const gcpConfig = getConfig(gcpConfigFilePath);

function gcpAnalyzeSentiment(analyzeText) {
    let url = gcpConfig["AnalyzeSentimentURL"] + "?key=" + gcpConfig["API_KEY"];
    let options = gcpConfig["options"]["body"];
    options["document"]["content"] = analyzeText;

    const postRes = fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(options)
    })
    .then((response) => {
        return response.json();
    });

    return postRes;
} 
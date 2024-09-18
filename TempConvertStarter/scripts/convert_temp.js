window.addEventListener("DOMContentLoaded", domLoaded);

function domLoaded() {
    // Register click event handler for the convert button
    document.getElementById("convertButton").addEventListener("click", convertTemperature);

    // Add event listeners to handle clearing the box that WAS NOT clicked
    document.getElementById("C_in").addEventListener("input", function() {
        document.getElementById("F_in").value = "";
    });

    document.getElementById("F_in").addEventListener("input", function() {
        document.getElementById("C_in").value = "";
    });
}

function convertTemperature() {
    const celsiusInput = document.getElementById("C_in");
    const fahrenheitInput = document.getElementById("F_in");
    const resultBox = document.getElementById("result");

    let temperature, convertedTemp;

    if (celsiusInput.value !== "") {
        temperature = parseFloat(celsiusInput.value);
        convertedTemp = convertCtoF(temperature);
        fahrenheitInput.value = convertedTemp.toFixed(2);
        resultBox.innerHTML = `${temperature}°C is ${convertedTemp.toFixed(2)}°F`;
    } else if (fahrenheitInput.value !== "") {
        temperature = parseFloat(fahrenheitInput.value);
        convertedTemp = convertFtoC(temperature);
        celsiusInput.value = convertedTemp.toFixed(2);
        resultBox.innerHTML = `${temperature}°F is ${convertedTemp.toFixed(2)}°C`;
    } else {
        resultBox.innerHTML = "Please enter a temperature to convert.";
    }

    updateWeatherIcon(fahrenheitInput.value !== "" ? parseFloat(fahrenheitInput.value) : convertedTemp);
}

function convertCtoF(C) {
    return C * 9/5 + 32;
}

function convertFtoC(F) {
    return (F - 32) * 5/9;
}

function updateWeatherIcon(tempF) {
    const weatherIcon = document.getElementById("weatherIcon");

    if (tempF <= -200 || tempF >= 200) {
        weatherIcon.src = "../images/dead.png";
    } else if (tempF <= 32) {
        weatherIcon.src = "../images/cold.png";
    } else if (tempF >= 90) {
        weatherIcon.src = "../images/hot.png";
    } else {
        weatherIcon.src = "../images/cool.png";
    }

    if (isNaN(tempF)) {
        weatherIcon.src = "../images/C-F.png";
    }
}

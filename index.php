<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live AdGuard Query Log</title>
    <link rel="stylesheet" type="text/css" href="style-light.css" id="styleSheet">

</head>

<body>

    <div id="header">
        <h1>Live AdGuard Query Log</h1>
        <div id="nav">
            <a href="https://deine-admin-seite" id="adminLink">Admin Page</a>
            <a href="https://github.com/Gamerou?tab=repositories" target="_blank" id="githubLink">My GitHub</a>
            <a href="#" id="darkModeSwitch">Dark/Light Mode</a>
        </div>
    </div>

    <ul id="queryLogList">
        <!-- Hier werden die Abfragen dynamisch hinzugefügt -->
    </ul>

    <script>
        function updateQueryLog() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var queryLogData = JSON.parse(xhr.responseText);
                    var queryLogList = document.getElementById('queryLogList');
                    queryLogList.innerHTML = '';

                    if (queryLogData.data.length > 0) {
                        queryLogData.data.forEach(function (logEntry) {
                            var logTime = new Date(logEntry.time);
                            var hours = ('0' + logTime.getHours()).slice(-2);
                            var minutes = ('0' + logTime.getMinutes()).slice(-2);
                            var seconds = ('0' + logTime.getSeconds()).slice(-2);

                            var listItem = document.createElement('li');
                            listItem.textContent = hours + ':' + minutes + ':' + seconds +
                                ' ' + logEntry.client_info.name +
                                ' ' + logEntry.client +
                                ' ' + logEntry.question.name +
                                ' ' + logEntry.status;

                            // Füge die Klassen basierend auf dem Filterstatus hinzu
                            if (logEntry.reason === 'FilteredBlackList') {
                                listItem.classList.add('filtered');
                            } else if (logEntry.reason === 'Rewrite') {
                                listItem.classList.add('rewritten');
                            }

                            queryLogList.appendChild(listItem);
                        });
                    } else {
                        var noDataItem = document.createElement('p');
                        noDataItem.textContent = 'Keine Daten gefunden.';
                        queryLogList.appendChild(noDataItem);
                    }
                }
            };

            xhr.open('GET', '/api/get_query_log.php', true);
            xhr.send();
        }

        setInterval(updateQueryLog, 1000);
        updateQueryLog();

        // Dark Mode Switcher
        var darkModeSwitch = document.getElementById('darkModeSwitch');
        darkModeSwitch.addEventListener('click', function() {
            var styleSheet = document.getElementById('styleSheet');
            var isDarkMode = styleSheet.href.includes('style-dark.css');
            styleSheet.href = isDarkMode ? 'style-light.css' : 'style-dark.css';
        });

    </script>

</body>

</html>
document.addEventListener('DOMContentLoaded', function() {
    const editorContainer = document.getElementById('editor-container');
    const textarea = document.getElementById('editor');
    
    // ЯВНО задаем базовый URL сайта - измените на свой!
    const SITE_BASE_URL = 'https://demo1.beautyhalf.ru/numerolog/images/';//здесь явно прописываем путь к папке на сайте
    
    // Сохраняем содержимое из textarea перед очисткой
    const savedContent = textarea.value;
    
    // Очищаем контейнер
    editorContainer.innerHTML = '';
    
    // Функция для преобразования относительного пути в абсолютный
    function makeAbsoluteUrl(relativeUrl) {
        if (!relativeUrl) return relativeUrl;
        
        // Если URL уже абсолютный (начинается с http://, https://, //)
        if (relativeUrl.match(/^(https?:)?\/\//)) {
            return relativeUrl;
        }
        
        // Если URL начинается с /, добавляем базовый URL
        if (relativeUrl.startsWith('/')) {
            // Удаляем первый слэш если он есть в базовом URL
            var base = SITE_BASE_URL.endsWith('/') ? SITE_BASE_URL.slice(0, -1) : SITE_BASE_URL;
            return base + relativeUrl;
        }
        
        // Если URL не начинается с / и не начинается с базового URL
        if (!relativeUrl.startsWith(SITE_BASE_URL)) {
            var base = SITE_BASE_URL.endsWith('/') ? SITE_BASE_URL : SITE_BASE_URL + '/';
            return base + relativeUrl;
        }
        
        // Если уже начинается с базового URL, возвращаем как есть
        return relativeUrl;
    }
    
    // Создаем адаптер для загрузки файлов
    function createSimpleUploadAdapter(loader) {
        return {
            upload: function() {
                return new Promise(function(resolve, reject) {
                    loader.file.then(function(file) {
                        var formData = new FormData();
                        formData.append('upload', file);
                        
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', 'img-cke.php', true);
                        
                        xhr.onload = function() {
                            if (xhr.status === 200) {
                                try {
                                    var response = JSON.parse(xhr.responseText);
                                    
                                    if (response.url) {
                                        // ПРЕОБРАЗУЕМ ОТНОСИТЕЛЬНЫЙ ПУТЬ В АБСОЛЮТНЫЙ
                                        var absoluteUrl = makeAbsoluteUrl(response.url);
                                        
                                        console.log('Исходный URL от сервера:', response.url);
                                        console.log('Преобразованный абсолютный URL:', absoluteUrl);
                                        
                                        resolve({
                                            default: absoluteUrl
                                        });
                                    } else if (response.error) {
                                        reject(response.error.message || 'Ошибка загрузки');
                                    } else {
                                        reject('Неизвестный ответ сервера');
                                    }
                                } catch (e) {
                                    reject('Ошибка разбора JSON: ' + e.message);
                                }
                            } else {
                                reject('Ошибка сервера: ' + xhr.status);
                            }
                        };
                        
                        xhr.onerror = function() {
                            reject('Ошибка сети');
                        };
                        
                        xhr.upload.onprogress = function(evt) {
                            if (evt.lengthComputable) {
                                loader.uploadTotal = evt.total;
                                loader.uploaded = evt.loaded;
                            }
                        };
                        
                        xhr.send(formData);
                    }).catch(function(error) {
                        reject('Ошибка получения файла: ' + error);
                    });
                });
            },
            
            abort: function() {
                // Можно реализовать отмену загрузки если нужно
            }
        };
    }
    
    // Функция-плагин для регистрации адаптера
    function MyCustomUploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
            return createSimpleUploadAdapter(loader);
        };
    }
    
    // Создаем редактор
    ClassicEditor
        .create(editorContainer, {
            language: 'ru',
            placeholder: 'Напишите статью...',
            initialData: savedContent,
            extraPlugins: [MyCustomUploadAdapterPlugin],
            
            // УБИРАЕМ ПРОБЛЕМНЫЕ ПЛАГИНЫ
            removePlugins: [
                'Table', 'TableToolbar', 'TableColumnResize', 
                'ImageToolbar', 'ImageCaption', 'ImageStyle',
                'MediaEmbed', 'LinkImage', 'PageBreak',
                'HorizontalLine', 'HtmlEmbed', 'Markdown',
                'CodeBlock', 'Highlight', 'FontSize',
                'FontFamily', 'FontColor', //'Alignment',
                'Indent', 'IndentBlock', 'TodoList',
                'SpecialCharacters',
                'Autoformat', 'BalloonToolbar', 'BlockToolbar' // ДОБАВЛЯЕМ ЭТИ
            ],
             alignment: {
            options: ['left', 'center', 'right', 'justify']
        },
            
            toolbar: {
                        items: [
                'heading', '|',
                'bold', 'italic', 'underline', '|',
                'alignment:left', 'alignment:center', 'alignment:right', 'alignment:justify', '|',
                'bulletedList', 'numberedList', '|',
                'link', 'uploadImage', '|',
                'undo', 'redo'
            ],
                shouldNotGroupWhenFull: true // ПРОСТАЯ ПАНОРАМА
            },
            
            // ПРОСТАЯ настройка изображений
            image: {
                toolbar: [
                    'imageTextAlternative'
                ]
            },
            
            // БАЗОВЫЕ настройки
            height: '300px',
            
            // ОТКЛЮЧАЕМ все лишние фичи
            toolbarLocation: 'bottom',
            shouldNotGroupWhenFull: true,
            
            // Упрощаем конфигурацию
            simpleUpload: {
                uploadUrl: 'img-cke.php'
            }
        })
        .then(function(editor) {
            window.editor = editor;
            
            // ПРОСТАЯ синхронизация с textarea
            editor.model.document.on('change:data', function() {
                textarea.value = editor.getData();
            });
            
            // Загружаем сохраненный контент
            if (savedContent && savedContent.trim() !== '') {
                editor.setData(savedContent);
            }
            
            // ПРОСТАЯ настройка стилей
            var editable = editor.ui.view.editable.element;
            if (editable) {
                editable.style.cssText = `
                    min-height: 300px !important;
                    max-height: 600px !important;
                    overflow-y: auto !important;
                    border: 2px solid #ddd !important;
                    border-radius: 8px !important;
                    padding: 20px !important;
                    font-size: 16px !important;
                    line-height: 1.6 !important;
                    background: white !important;
                    font-family: inherit !important;
                    box-sizing: border-box !important;
                `;
            }
            
            console.log('CKEditor успешно загружен.');
        })
        .catch(function(error) {
            console.error('Ошибка CKEditor:', error);
            console.error('Детали ошибки:', error.stack);
            
            // ПРОСТОЙ fallback
            editorContainer.innerHTML = `
                <textarea style="
                    width: 100%;
                    min-height: 300px;
                    padding: 20px;
                    border: 2px solid #ddd;
                    border-radius: 8px;
                    font-size: 16px;
                    font-family: inherit;
                " placeholder="Напишите статью...">${savedContent}</textarea>
            `;
            
            var fallbackTextarea = editorContainer.querySelector('textarea');
            fallbackTextarea.addEventListener('input', function() {
                textarea.value = this.value;
            });
        });
    
    // Упрощенная функция для fallback загрузки
    window.uploadImageManually = function(input) {
        if (!input.files[0]) return;
        
        alert('В режиме fallback загрузка изображений недоступна. Используйте обычный CKEditor.');
        input.value = '';
    };
});

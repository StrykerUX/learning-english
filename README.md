# English Trainer 📚

Una aplicación web gamificada para aprender inglés de manera interactiva y divertida.

## 🎮 Descripción

English Trainer es una plataforma educativa que combina aprendizaje de idiomas con mecánicas de juego. Los usuarios progresan a través de 8 niveles diferentes, cada uno enfocado en aspectos específicos del inglés.

## ✨ Características

- **8 Niveles Progresivos**: Desde vocabulario básico hasta gramática avanzada
- **Sistema de Puntos y Estrellas**: Gamificación completa con recompensas
- **Dashboard Interactivo**: Mapa visual del progreso como un videojuego
- **Teoría Integrada**: Cada juego incluye su página de explicación teórica
- **Progreso Persistente**: LocalStorage para guardar el avance
- **Diseño Responsivo**: Funciona en escritorio y móviles

## 🎯 Los 8 Niveles

### Vocabulario (Niveles 1-3)
1. **Palabras Básicas**: 20 palabras esenciales del inglés
2. **Memorama**: Encuentra las parejas inglés-español
3. **Ahorcado**: Adivina palabras con pistas

### Gramática (Niveles 4-7)
4. **Presente Simple**: Domina rutinas y hechos
5. **Presente Continuo**: Acciones que ocurren ahora
6. **Pasado Simple**: Eventos completados en el pasado
7. **Futuro Simple**: Planes y predicciones

### Especial (Nivel 8)
8. **Preposiciones**: Aprende dónde están las cosas

## 🛠️ Tecnologías

- **Frontend**: HTML5, CSS3, JavaScript (jQuery)
- **Backend**: PHP (para estructura de páginas)
- **Base de Datos**: No requiere (localStorage)
- **Iconos**: Font Awesome
- **Fuentes**: Google Fonts (Orbitron, Space Mono)

## 📁 Estructura del Proyecto

```
learning-english/
├── index.php              # Dashboard principal
├── css/
│   └── style.css         # Estilos principales
├── js/
│   └── main.js           # JavaScript principal
├── games/                # Los 8 juegos
│   ├── vocabulary-basic.php
│   ├── memory-game.php
│   ├── hangman.php
│   ├── present-simple.php
│   ├── present-continuous.php
│   ├── past-simple.php
│   ├── future-simple.php
│   └── prepositions.php
├── theory/               # Páginas de teoría
│   ├── basic-words.php
│   ├── memory-tips.php
│   ├── spelling-tips.php
│   ├── present-simple.php
│   ├── present-continuous.php
│   ├── past-simple.php
│   ├── future-simple.php
│   └── prepositions.php
└── README.md
```

## 🚀 Instalación

1. Clona el repositorio:
```bash
git clone [URL_DEL_REPOSITORIO]
cd learning-english
```

2. Configura un servidor web local (XAMPP, WAMP, MAMP):
   - Copia el proyecto a la carpeta htdocs/www del servidor
   - Inicia Apache

3. Abre en tu navegador:
```
http://localhost/learning-english
```

## 🎨 Diseño

- **Estilo**: Neo-brutalismo suave con temática espacial
- **Colores**: Cian (#0ff), dorado (#ffd700), verde (#16a34a)
- **Fondo**: Espacio con estrellas y planetas animados
- **UI**: Elementos de videojuego retro-futurista

## 📱 Responsive Design

El proyecto está optimizado para:
- 📱 Móviles (320px+)
- 📱 Tablets (768px+)  
- 💻 Escritorio (1024px+)

## 🔧 Personalización

Para personalizar el proyecto:

1. **Colores**: Modifica las variables CSS en `css/style.css`
2. **Juegos**: Edita los arrays de datos en cada archivo PHP
3. **Niveles**: Ajusta la configuración en `js/main.js`
4. **Contenido**: Modifica las páginas de teoría según necesidades

## 🎮 Sistema de Progreso

- **Puntos**: Se ganan por respuestas correctas
- **Estrellas**: 1-3 estrellas por rendimiento
- **Desbloqueo**: Los niveles se abren progresivamente
- **Persistencia**: Progreso guardado en localStorage

## 🤝 Contribuir

¡Las contribuciones son bienvenidas!

1. Fork del proyecto
2. Crea una rama para tu feature
3. Commit de tus cambios
4. Push a la rama
5. Abre un Pull Request

## 📜 Licencia

Este proyecto está bajo la Licencia MIT. Ver archivo `LICENSE` para más detalles.

## 🐛 Reportar Bugs

Si encuentras algún problema, por favor abre un issue describiendo:
- El problema específico
- Pasos para reproducirlo
- Navegador y versión
- Screenshots si es posible

## 👨‍💻 Autor

Desarrollado con ❤️ para hacer el aprendizaje del inglés más divertido y accesible.

---

⭐ Si te gusta este proyecto, dale una estrella en GitHub!
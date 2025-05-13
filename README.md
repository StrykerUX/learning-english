# 🚀 English Space Explorer - Learning Adventure

Una aplicación web gamificada para aprender inglés de manera interactiva y divertida, con temática espacial y mecánicas de videojuego.

## 🌟 Características Principales

- **Dashboard Interactivo**: Mapa espacial con 8 niveles progresivos
- **Sistema de Progresión**: Puntos, estrellas y desbloqueo de niveles
- **Teoría Integrada**: Cada nivel incluye su página de explicación teórica
- **Diseño Espacial**: Fondo animado con estrellas y asteroides
- **Responsive Design**: Optimizado para móviles, tablets y escritorio
- **Progreso Persistente**: Guardado automático en localStorage
- **Temporizador**: Límite de tiempo configurable para cada pregunta
- **Feedback Visual**: Animaciones y notificaciones interactivas

## 🎮 Los 8 Niveles de Aprendizaje

### 🌍 Vocabulario y Palabras (Niveles 1-3)
1. **Vocabulario Básico** - 40 palabras esenciales organizadas por categorías
   - Hogar y Familia • Comida y Cocina • Oficina y Trabajo
   - Escuela y Educación • Ciudad y Calle
2. **Memorama** - Juego de memoria para emparejar palabras
3. **Ahorcado** - Adivina palabras con pistas y letras

### 📚 Gramática (Niveles 4-7)
4. **Presente Simple** - Rutinas, hechos y hábitos diarios
5. **Presente Continuo** - Acciones que ocurren en el momento
6. **Pasado Simple** - Eventos completados en el pasado
7. **Futuro Simple** - Planes y predicciones

### 🎯 Especial (Nivel 8)
8. **Preposiciones** - Aprende sobre posiciones y ubicaciones

## 🛠️ Tecnologías Utilizadas

- **Frontend**: HTML5, CSS3 (Variables CSS), JavaScript (ES6+)
- **Backend**: PHP (para estructura de páginas)
- **Estilos**: CSS Grid, Flexbox, Animaciones CSS
- **Iconos**: Font Awesome 6.0
- **Fuentes**: Google Fonts (Space Grotesk, JetBrains Mono)
- **Framework**: Vanilla JavaScript (sin dependencias)

## 📁 Estructura del Proyecto

```
learning-english/
├── index.html                  # Dashboard principal
├── congratulations.html        # Página de felicitaciones
├── 📁 css/
│   ├── dashboard.css          # Estilos del dashboard
│   ├── games.css              # Estilos de los juegos
│   ├── hangman.css            # Estilos específicos del ahorcado
│   ├── style.css              # Estilos generales
│   └── theory.css             # Estilos de las páginas de teoría
├── 📁 js/
│   ├── dashboard.js           # Lógica del dashboard
│   ├── games.js               # Funciones generales de juegos
│   ├── main.js                # JavaScript principal
│   └── theory.js              # Lógica de páginas de teoría
├── 📁 games/
│   ├── vocabulary-basic.php   # Juego de vocabulario básico
│   ├── memory-game.php        # Juego de memoria
│   ├── hangman.php            # Juego del ahorcado
│   ├── present-simple.php     # Presente simple
│   ├── present-continuous.php # Presente continuo
│   ├── past-simple.php        # Pasado simple
│   ├── future-simple.php      # Futuro simple
│   └── prepositions.php       # Preposiciones
├── 📁 theory/
│   ├── basic-words.php        # Teoría de palabras básicas
│   ├── memory-tips.php        # Consejos de memoria
│   ├── spelling-tips.php      # Consejos de ortografía
│   ├── present-simple.php     # Teoría presente simple
│   ├── present-continuous.php # Teoría presente continuo
│   ├── past-simple.php        # Teoría pasado simple
│   ├── future-simple.php      # Teoría futuro simple
│   └── prepositions.php       # Teoría de preposiciones
└── README.md
```

## 🚀 Instalación y Configuración

### Requisitos Previos
- Servidor web con soporte PHP (XAMPP, WAMP, MAMP)
- Navegador web moderno (Chrome, Firefox, Edge, Safari)

### Pasos de Instalación

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/tu-usuario/learning-english.git
   cd learning-english
   ```

2. **Configurar servidor local**
   - Copia el proyecto a la carpeta `htdocs` (XAMPP) o `www` (WAMP/MAMP)
   - Inicia el servidor Apache

3. **Acceder a la aplicación**
   ```
   http://localhost/learning-english
   ```

## 🎨 Diseño y Estilo

### Colores Principales
- **Fondo Espacial**: `#1a1a2e` (bg-space)
- **Colores Pastel**: Rosa, Violeta, Azul, Verde, Amarillo, Naranja
- **Colores Brillantes**: Violeta (`#c084fc`), Rosa (`#f472b6`), Azul (`#60a5fa`)

### Características Visuales
- **Tema**: Neo-brutalismo suave con estética espacial
- **Animaciones**: Estrellas parpadeantes, asteroides flotantes
- **Efectos**: Sombras suaves, resplandor, transiciones suaves
- **Tipografía**: Space Grotesk para texto, JetBrains Mono para código

## 🎯 Mecánicas del Juego

### Sistema de Puntuación
- **Respuesta Correcta**: +10 puntos
- **Respuesta Incorrecta**: -5 puntos
- **Tiempo Agotado**: -5 puntos

### Sistema de Estrellas
- **⭐ 1 Estrella**: 50% de respuestas correctas
- **⭐⭐ 2 Estrellas**: 70% de respuestas correctas
- **⭐⭐⭐ 3 Estrellas**: 90% de respuestas correctas

### Características por Nivel
- **Temporizador**: 12 segundos por pregunta
- **Progresión**: Los niveles se desbloquean secuencialmente
- **Persistencia**: El progreso se guarda automáticamente

## 📱 Responsive Design

La aplicación está optimizada para:
- **📱 Móviles**: 320px - 767px
- **📱 Tablets**: 768px - 1023px
- **💻 Escritorio**: 1024px+

### Adaptaciones Móviles
- Header colapsable
- Grid de 2x2 en lugar de 4x1 para opciones
- Botones más grandes para mejor usabilidad
- Navegación optimizada para touch

## 🔧 Personalización

### Modificar Colores
Edita las variables CSS en `css/dashboard.css`:
```css
:root {
    --purple-bright: #c084fc;
    --pink-bright: #f472b6;
    /* ... otros colores */
}
```

### Agregar Nuevos Niveles
1. Crea el archivo del juego en `games/`
2. Crea la página de teoría en `theory/`
3. Actualiza `js/dashboard.js` para incluir el nuevo nivel

### Cambiar Contenido
- **Vocabulario**: Edita el array `vocabulary` en `vocabulary-basic.php`
- **Gramática**: Modifica los arrays de preguntas en cada archivo PHP

## 🤝 Contribuir

¡Las contribuciones son bienvenidas! Sigue estos pasos:

1. **Fork** el proyecto
2. **Crea** una rama para tu característica (`git checkout -b feature/nueva-caracteristica`)
3. **Commit** tus cambios (`git commit -m 'Añade nueva característica'`)
4. **Push** a la rama (`git push origin feature/nueva-caracteristica`)
5. **Abre** un Pull Request

### Pautas de Contribución
- Mantén el estilo de código consistente
- Añade comentarios para código complejo
- Prueba tu código en diferentes navegadores
- Sigue la convención de commits semánticos

## 📊 Rendimiento

### Optimizaciones Implementadas
- **CSS**: Variables nativas, sin preprocesadores
- **JavaScript**: Vanilla JS, sin frameworks pesados
- **Imágenes**: SVG para iconos, CSS para animaciones
- **Carga**: Lazy loading de estilos específicos por página

## 🐛 Reportar Problemas

Si encuentras algún bug, por favor abre un issue e incluye:
- **Descripción** del problema
- **Pasos** para reproducirlo
- **Navegador** y versión
- **Screenshots** si es posible

## 📜 Licencia

Este proyecto está bajo la Licencia MIT. Ver archivo `LICENSE` para más detalles.

## 🙏 Agradecimientos

- **Font Awesome** por los iconos
- **Google Fonts** por las tipografías
- **Comunidad** de desarrolladores por inspiración y feedback

## 📈 Roadmap

### Próximas Características
- [ ] Sistema de logros y badges
- [ ] Modo multijugador
- [ ] Generador de reportes de progreso
- [ ] Soporte para múltiples idiomas
- [ ] Modo offline con PWA
- [ ] Integración con redes sociales

## 👥 Equipo

Desarrollado con ❤️ por el equipo de English Space Explorer.

---

⭐ **¡Dale una estrella si te gusta el proyecto!** ⭐

## Enlaces Útiles

- [Demo en Vivo](https://tu-dominio.com/learning-english)
- [Documentación](https://tu-dominio.com/docs)
- [Reportar Bug](https://github.com/tu-usuario/learning-english/issues)
- [Solicitar Característica](https://github.com/tu-usuario/learning-english/issues/new)

---

*Última actualización: Mayo 2025*
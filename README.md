# English Trainer - MVP

🚀 **Plataforma de aprendizaje de inglés gamificada**

## 📋 Descripción del Proyecto

English Trainer es una aplicación web interactiva diseñada para ayudar a principiantes a aprender inglés a través de juegos divertidos y teoría práctica. El diseño utiliza un estilo **Neo-Brutalismo suave** con colores pastel para crear una experiencia moderna y atractiva.

## 🎮 Características del MVP

### ✨ 5 Niveles de Aprendizaje

1. **Vocabulario Básico** - Palabras esenciales (colores, números, familia, animales)
2. **Presente Simple** - Oraciones en presente
3. **Presente Continuo** - Acciones en progreso
4. **Pasado Simple** - Eventos del pasado
5. **Futuro Simple** - Planes y predicciones

### 🎯 Funcionalidades

- ✅ **Dashboard con progreso visual**
- ✅ **Sistema de puntos gamificado**
- ✅ **Teoría en español antes de cada juego**
- ✅ **10 preguntas por nivel**
- ✅ **Feedback inmediato con explicaciones**
- ✅ **Sistema de desbloqueo progresivo**
- ✅ **Diseño responsive para móviles**
- ✅ **Almacenamiento local de progreso**

### 🎨 Diseño

- **Estilo**: Neo-Brutalismo suave
- **Colores**: Paleta pastel motivadora
- **Iconos**: Tabler Icons
- **Fuente**: Inter (Google Fonts)
- **Animaciones**: CSS suaves y elegantes

## 🚀 Instalación y Uso

### Requisitos Previos

- Servidor web (Apache/Nginx)
- PHP 7.4+ (solo para estructura de archivos)
- Navegador moderno

### Instalación

1. **Descarga del proyecto**
   ```bash
   git clone [URL_DEL_REPOSITORIO]
   cd EnglishTrainer
   ```

2. **Configurar servidor local**
   - Coloca los archivos en tu directorio web (htdocs, www, etc.)
   - O usa PHP built-in server:
   ```bash
   php -S localhost:8000
   ```

3. **Abrir en navegador**
   ```
   http://localhost:8000
   ```

## 📁 Estructura del Proyecto

```
EnglishTrainer/
├── index.php              # Dashboard principal
├── css/
│   └── style.css         # Estilos principales
├── js/
│   └── main.js           # JavaScript principal
├── theory/               # Páginas de teoría
│   ├── level-1.php       # Vocabulario Básico
│   ├── level-2.php       # Presente Simple
│   ├── level-3.php       # Presente Continuo
│   ├── level-4.php       # Pasado Simple
│   └── level-5.php       # Futuro Simple
└── games/                # Juegos interactivos
    ├── level-1.php       # Juego Vocabulario
    ├── level-2.php       # Juego Presente Simple
    ├── level-3.php       # Juego Presente Continuo
    ├── level-4.php       # Juego Pasado Simple
    └── level-5.php       # Juego Futuro Simple
```

## 💾 Sistema de Progreso

El progreso se guarda automáticamente en `localStorage` del navegador:

- **Puntos totales acumulados**
- **Niveles completados**
- **Progreso de cada nivel**
- **Mejor puntuación por nivel**

## 🎮 Mecánicas de Juego

### Sistema de Puntos
- ✅ **Respuesta correcta**: +10 puntos
- ❌ **Respuesta incorrecta**: 0 puntos
- 🏆 **Nivel completado**: 70% mínimo requerido

### Progresión
- Los niveles se desbloquean secuencialmente
- El nivel 1 siempre está disponible
- Cada nivel siguiente requiere completar el anterior

## 🛠️ Tecnologías Utilizadas

### Frontend
- **HTML5**: Estructura semántica
- **CSS3**: Diseño responsivo y animaciones
- **JavaScript**: Interactividad
- **jQuery**: Manipulación del DOM

### Servicios Externos
- **Google Fonts**: Tipografía Inter
- **Tabler Icons**: Iconografía SVG
- **jQuery CDN**: Biblioteca JavaScript

## 🚀 Futuras Mejoras

### Fase 2
- [ ] Base de datos persistente
- [ ] Sistema de usuarios
- [ ] Audio y pronunciación
- [ ] Más tipos de juegos

### Fase 3
- [ ] Dificultad adaptativa
- [ ] Estadísticas avanzadas
- [ ] Elementos sociales
- [ ] Certificados de completción

## 📱 Responsive Design

La aplicación está optimizada para:
- 💻 **Desktop** (1200px+)
- 💻 **Tablet** (768px-1199px)
- 📱 **Mobile** (320px-767px)

## 🎨 Paleta de Colores

```css
--primary-color: #E8F4FD    /* Azul pastel */
--secondary-color: #F0E6FF  /* Violeta pastel */
--accent-color: #FFEAE6     /* Rosa pastel */
--success-color: #E6F7F1    /* Verde pastel */
--warning-color: #FFF3E6    /* Naranja pastel */
```

## 📄 Licencia

MVP creado para prueba de concepto.

## 👨‍💻 Desarrollo

**Tiempo de desarrollo**: ~2 horas
**Metodología**: Desarrollo ágil, MVP funcional

---

¡Diviértete aprendiendo inglés! 🌟

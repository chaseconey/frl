<svg xmlns="http://www.w3.org/2000/svg" viewBox="165.051 14.298 169.897 121.405" {{ $attributes }}>
    <defs>
        <linearGradient id="editing-outline-gradient" x1="-.5" x2="1.5" y1=".5" y2=".5">
            <stop offset="0"/>
            <stop offset="1" stop-color="#ff001a"/>
        </linearGradient>
        <filter id="editing-outline" x="-100%" y="-100%" width="300%" height="300%">
            <feMorphology in="SourceGraphic" operator="dilate" radius="4" result="outline"/>
            <feComposite operator="out" in="outline" in2="SourceAlpha"/>
        </filter>
    </defs>
    <g filter="url(#editing-outline)">
        <path d="M30.21-33.92q-5.19 0-8.96-1.73L19.2-25.28h12.35q0 3.39-1.69 5.54-1.7 2.14-4.77 2.14-3.33 0-6.4-1.22-.64-.25-.71-.32L14.34 0H.38l8.13-42.24h28.55q0 3.9-1.83 6.11-1.82 2.21-5.02 2.21zM48.58 0h-13.7l7.81-42.05q6.33-.7 15.58-.7t13.54 2.69q4.29 2.68 4.29 8.09t-2.79 8.8q-2.78 3.39-7.58 4.48 1.09 5.31 3.58 9.6 2.31 4.03 4.99 5.31-.96 2.69-2.91 3.88-1.95 1.18-4.73 1.18-2.79 0-4.96-1.63-2.18-1.63-3.91-4.64-3.65-6.53-4.03-16.83h.45q4.73-.13 7.1-2.6 2.37-2.46 2.37-7.64 0-6.47-5.44-6.72h-1.41q-.57 0-.89.06L48.58 0zm57.21-9.86q1.22 1.54 1.22 4.52 0 2.97-2.27 4.8-2.28 1.82-6.24 1.82-2.31 0-5.89-.51-7.04-1.09-9.06-1.09-2.01 0-2.85.1-.83.09-2.17.22l7.74-42.24h14.02l-6.4 35.2q.83.13 1.6.13h1.6q5.37 0 8.7-2.95z" fill="url(#editing-outline-gradient)" transform="translate(196.305 97.015)"/>
    </g>
    <style>
    </style>
</svg>

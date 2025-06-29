# Imagem base com Node.js
FROM node:18

# Define o diretório de trabalho
WORKDIR /app

# Copia os arquivos de dependência primeiro (boa prática)
COPY ./package*.json ./

# Instala dependências do projeto
RUN npm install

# Copia o restante da aplicação para o container
COPY . .

# Expondo a porta onde o Next roda
EXPOSE 3000

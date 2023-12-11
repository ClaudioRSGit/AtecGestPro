**Tabela `Actions`:**

Descrição: Contém as informações sobre as ações realizadas.

Colunas Principais: Id, Description.

  - **Id (Primary Key):** Identificador único para cada ação.
  - **Description:** Descrição da ação realizada.
  - **Technician_Id:** Identificador do técnico associado à ação.
  - **Created_at:** Data e hora de criação da ação.

  Exemplo de dados:

  | Id | Description        | Technician_Id | Created_at           |
  |----|--------------------|----------------|----------------------|
  | 1  | Update Status      | 101            | 2023-11-24 14:30:00 |
  | 2  | Add Attachment     | 102            | 2023-11-24 15:45:00 |
<br>

**Tabela `Class`:**

Descrição: Contém as informações sobre as Turmas.

Colunas Principais: Id, ClassName.

  - **Id (Primary Key):** Identificador único para cada classe.
  - **Description:** Descrição da classe.
  - **Course_Id:** Identificador do curso associado à classe.
  - **IsDeleted:** Indica se a classe foi excluída.
  - **Updated_at:** Data e hora da última atualização.
  - **Deleted_at:** Data e hora da exclusão.

  Exemplo de dados:

  | Id | Description        | Course_Id | IsDeleted | Updated_at           | Deleted_at           |
  |----|--------------------|-----------|-----------|----------------------|----------------------|
  | 1  | Programming 101    | 201       | 0         | 2023-11-24 10:15:00 | NULL                 |
  | 2  | Data Science Basics| 202       | 1         | 2023-11-24 11:30:00 | 2023-11-24 11:45:00 |
<br>

**Tabela `Clothing_Delivery`:**

Descrição: Contém as informações sobre as entregas de roupas.

Colunas Principais: Id, DeliveryDate, Quantity.

  - **Id (Primary Key):** Identificador único para cada entrega de roupas.
  - **User_Id:** Identificador do usuário associado à entrega.
  - **Delivered:** Indica se a entrega foi realizada (1 para sim, 0 para não).
  - **Delivered_at:** Data e hora da entrega.
  - **Updated_at:** Data e hora da última atualização.
  - **Deleted_at:** Data e hora da exclusão.
  - **Additional_Notes:** Notas adicionais sobre a entrega.

  Exemplo de dados:

  | Id | User_Id | Delivered | Delivered_at         | Updated_at           | Deleted_at           | Additional_Notes       |
  |----|---------|-----------|----------------------|----------------------|----------------------|-------------------------|
  | 1  | 501     | 1         | 2023-11-24 09:30:00  | 2023-11-24 10:15:00 | NULL                 | Received without issue |
  | 2  | 502     | 0         | NULL                 | 2023-11-24 11:45:00 | NULL                 | Waiting for confirmation|
<br>

**Tabela `Comments`:**

   Descrição: Contém as informações sobre os comentários.
   
   Colunas Principais: Id, CommentText.


  - **Id (Primary Key):** Identificador único para cada comentário.
  - **Title:** Título do comentário.
  - **Description:** Descrição do comentário.
  - **User_Id:** Identificador do usuário que fez o comentário.
  - **Ticket_Id:** Identificador do ticket associado ao comentário.
  - **IsPublic:** Indica se o comentário é público (1 para sim, 0 para não).
  - **Created_at:** Data e hora de criação do comentário.
  - **Updated_at:** Data e hora da última atualização.
  - **Deleted_at:** Data e hora da exclusão.

  Exemplo de dados:

  | Id | Title          | Description             | User_Id | Ticket_Id | IsPublic | Created_at           | Updated_at           | Deleted_at           |
  |----|----------------|-------------------------|---------|-----------|----------|----------------------|----------------------|----------------------|
  | 1  | Question       | Need more information.   | 301     | 201       | 1        | 2023-11-24 08:45:00 | 2023-11-24 09:30:00 | NULL                 |
  | 2  | Update          | Issue resolved.         | 302     | 202       | 0        | 2023-11-24 10:00:00 | 2023-11-24 10:45:00 | NULL                 |
<br>

**Tabela `Course`:**

Descrição: Contém os detalhes de todos os cursos disponiveis na da ATEC.

Colunas Principais: Id, Description

  - **Id (Primary Key):** Identificador único para cada curso.
  - **Description:** Descrição do curso.
  - **Code:** Código do curso.
  - **IsDeleted:** Indica se o curso foi excluído (1 para sim, 0 para não).
  - **Created_at:** Data e hora de criação do curso.
  - **Updated_at:** Data e hora da última atualização.
  - **Deleted_at:** Data e hora da exclusão.

  Exemplo de dados:

  | Id | Description               | Code   | IsDeleted | Created_at           | Updated_at           | Deleted_at           |
  |----|---------------------------|--------|-----------|----------------------|----------------------|----------------------|
  | 1  | Introduction to Programming| PROG101| 0         | 2023-11-24 09:00:00 | 2023-11-24 09:30:00 | NULL                 |
  | 2  | Web Development Basics     | WEB101 | 0         | 2023-11-24 10:15:00 | 2023-11-24 10:45:00 | NULL                 |
<br>

**Tabela `Material`:**

Descrição: Contém as informações sobre os materiais disponíveis.

Colunas Principais: Id, MaterialName.

  - **Id (Primary Key):** Identificador único.
  - **Name:** Nome do material.
  - **Description:** Descrição do material.
  - **IsInternal:** Indica se o material é interno (1 para sim, 0 para não).
  - **Quantity:** Quantidade disponível do material.
  - **Aquisition_Date:** Data de aquisição do material.
  - **Supplier:** Fornecedor do material.
  - **Type_IsClothing:** Indica se o material é do tipo roupa (1 para sim, 0 para não).
  - **Gender:** Gênero do material (apenas para materiais do tipo roupa).
  - **Size:** Tamanho do material (apenas para materiais do tipo roupa).
  - **Role:** Papel ou função do material (apenas para materiais do tipo roupa).
  - **IsDeleted:** Indica se o material foi excluído (1 para sim, 0 para não).
  - **Created_at:** Data e hora de criação do material.
  - **Updated_at:** Data e hora da última atualização.
  - **Deleted_at:** Data e hora da exclusão.

  Exemplo de dados:

  | Id | Name          | Description               | IsInternal | Quantity | Aquisition_Date | Supplier       | Type_IsClothing | Gender | Size | Role      | IsDeleted | Created_at           | Updated_at           | Deleted_at           |
  |----|---------------|---------------------------|------------|----------|-----------------|----------------|------------------|--------|------|-----------|-----------|----------------------|----------------------|----------------------|
  | 1  | Laptop        | High-performance laptop   | 1          | 10       | 2023-11-24      | TechSupplier   | 0                | NULL   | NULL | NULL      | 0         | 2023-11-24 09:45:00 | 2023-11-24 10:15:00 | NULL                 |
  | 2  | Safety Goggles| Protective eyewear        | 1          | 50       | 2023-11-24      | SafetyEquip    | 0                | NULL   | NULL | NULL      | 0         | 2023-11-24 11:00:00 | 2023-11-24 11:30:00 | NULL                 |
<br>

**Tabela `Material_Clothing_Delivery`:**

Descrição: Contém as informações das  entrega de roupas.

Colunas Principais: Id, Clothing_Delivery_Id, Material_Id.

  - **Id (Primary Key):** Identificador único.
  - **Clothing_Delivery_Id (Foreign Key):** Referência à entrega de roupas associada.
  - **Material_Id (Foreign Key):** Referência ao material associado.

  Exemplo de dados:

  | Id | Clothing_Delivery_Id | Material_Id |
  |----|-----------------------|--------------|
  | 1  | 101                   | 1            |
  | 2  | 102                   | 2            |
<br>

**Tabela `Material_Training`:**

 Descrição: Contém as informações sobre os materiais de treinamento.

Colunas Principais: Id, Material_Id, Training_Id, Quantity.

  - **Id (Primary Key):** Identificador único.
  - **Material_Id (Foreign Key):** Referência ao material associado.
  - **Training_Id (Foreign Key):** Referência ao treinamento associado.
  - **Quantity:** Quantidade de material relacionado ao treinamento.

  Exemplo de dados:

  | Id | Material_Id | Training_Id | Quantity |
  |----|--------------|--------------|----------|
  | 1  | 1            | 1            | 20       |
  | 2  | 2            | 2            | 30       |
<br>

**Tabela `Notifications`:**

Descrição: Contém as informações sobre as notificações.

Colunas Principais: Id, NotificationText.

  - **Id (Primary Key):** Identificador único para cada notificação.
  - **IsDeleted:** Indica se a notificação foi excluída.
  - **CreatedAt:** Data e hora de criação da notificação.
  - **DeletedAt:** Data e hora de exclusão da notificação.
  - **Notification_Type_Id (Foreign Key):** Referência ao tipo de notificação.
  - **Description:** Descrição da notificação.
  - **Object_Id:** Identificador do objeto associado à notificação.

  Exemplo de dados:

  | Id | IsDeleted | CreatedAt            | DeletedAt            | Notification_Type_Id | Description       | Object_Id |
  |----|------------|----------------------|----------------------|------------------------|-------------------|------------|
  | 1  | 0          | 2023-11-24 13:09:29  | NULL                 | 101                               | Nova mensagem   | 201        |
  | 2  | 1          | 2023-11-23 15:30:45  | 2023-11-23 16:00:12  | 102                               | Atualização         | 202        |
<br>

**Tabela `Notifications_Type`:**

Descrição: Contém as informações sobre os tipos de notificações disponíveis.

Colunas Principais: Id, TypeName.

  - **Id (Primary Key):** Identificador único para cada tipo de notificação.
  - **Description:** Descrição do tipo de notificação.
  - **Code:** Código identificador do tipo de notificação.

  Exemplo de dados:

  | Id | Description          | Code  |
  |----|----------------------|-------|
  | 101| Nova mensagem        | MSG   |
  | 102| Atualização           | UPD   |
<br>

**Tabela `Notifications_Users`:**

Descrição: Contém as informações sobre as notificações dos usuarios.

Colunas Principais: Id, User_Id, Notification_Id.

  - **Id (Primary Key):** Identificador único.
  - **User_Id (Foreign Key):** Referência ao usuário associado à notificação.
  - **Notification_Id (Foreign Key):** Referência à notificação associada.
  - **isRead:** Indica se a notificação foi lida pelo usuário.

  Exemplo de dados:

  | Id | User_Id | Notification_Id | isRead |
  |----|---------|------------------|--------|
  | 1  | 301     | 1                | 0      |
  | 2  | 302     | 2                | 1      |
<br>

**Tabela `Partner_Trainings_Users`:**

Descrição: Contém as informações sobre treinamentos, em qual parceiro foi realizado o treinamento.
     
Colunas Principais: Id, Partner_Id, Training_Id, User_Id, Start_Date,End_Date.

  - **Id (Primary Key):** Identificador único.
  - **Partner_Id (Foreign Key):** Referência ao parceiro associado.
  - **Training_Id (Foreign Key):** Referência ao treinamento associado.
  - **User_Id (Foreign Key):** Referência ao usuário associado.
  - **Start_Date:** Data de início da relação.
  - **End_Date:** Data de término da relação.
  - **CreatedAt:** Data e hora de criação do registro.
  - **UpdatedAt:** Data e hora da última atualização do registro.
  - **DeletedAt:** Data e hora de exclusão do registro.

  Exemplo de dados:

  | Id | Partner_Id | Training_Id | User_Id | Start_Date          | End_Date            | CreatedAt           | UpdatedAt           | DeletedAt           |
  |----|------------|--------------|---------|---------------------|---------------------|---------------------|---------------------|---------------------|
  | 1  | 401        | 501          | 601     | 2023-11-01 08:00:00 | 2023-11-30 17:00:00 | 2023-11-01 10:30:15 | 2023-11-28 14:20:45 | NULL                |
  | 2  | 402        | 502          | 602     | 2023-11-15 09:30:00 | 2023-11-30 15:45:00 | 2023-11-15 11:40:22 | 2023-11-29 12:15:30 | 2023-11-30 09:10:05 |
<br>

**Tabela `Partners`:**

 Descrição: Contém as informações dos parceiros.

Colunas Principais: Id, Name, Description, Address, Contact.

  - **Id (Primary Key):** Identificador único para cada parceiro.
  - **Name:** Nome do parceiro.
  - **Description:** Descrição do parceiro.
  - **Address:** Endereço do parceiro.
  - **Contact:** Informações de contato do parceiro.
  - **IsDeleted:** Indica se o parceiro foi excluído.
  - **CreatedAt:** Data e hora de criação do parceiro.
  - **UpdatedAt:** Data e hora da última atualização do parceiro.
  - **DeletedAt:** Data e hora de exclusão do parceiro.

  Exemplo de dados:

  | Id | Name             | Description            | Address                  | Contact             | IsDeleted | CreatedAt           | UpdatedAt           | DeletedAt           |
  |----|------------------|------------------------|--------------------------|---------------------|-----------|---------------------|---------------------|---------------------|
  | 401| Partner A        | Training partner       | Rua Partner, 123         | partner@email.com  | 0         | 2023-11-01 10:00:00 | 2023-11-25 15:30:00 | NULL                |
  | 402| Partner B        | Fitness equipment      | Av. Commercial, 567      | partnerb@email.com | 1         | 2023-11-15 11:20:00 | 2023-11-29 14:45:00 | 2023-11-30 10:05:00 |
<br>

**Tabela `Role_User`:**

Descrição: Contém as informações  das funções de cada usuário .

Colunas Principais: Id, Role_Id, User_Id.

  - **Id (Primary Key):** Identificador único.
  - **Role_Id (Foreign Key):** Referência à função associada.
  - **User_Id (Foreign Key):** Referência ao usuário associado.

  Exemplo de dados:

  | Id | Role_Id | User_Id |
  |----|---------|---------|
  | 1  | 801     | 901     |
  | 2  | 802     | 902     |
<br>

**Tabela `Roles`:**

Descrição: Contém as informações das funções disponíveis para cada usuário.

Colunas Principais: Id, RoleName.

  - **Id (Primary Key):** Identificador único para cada função.
  - **Name:** Nome da função.
  - **Description:** Descrição da função.

  Exemplo de dados:

  | Id | Name           | Description                  |
  |----|----------------|------------------------------|
  | 801| Administrator  | System administrator role    |
  | 802| Trainer        | Fitness program trainer role |
<br>

**Tabela `Ticket_Category`:**

 Descrição: Contém as informações sobre as Categorias de tickets.

Colunas Principais: Id, Description.

  - **Id (Primary Key):** Identificador único para cada categoria de ticket.
  - **Description:** Descrição da categoria de ticket.
  - **IsDeleted:** Indica se a categoria foi excluída.
  - **CreatedAt:** Data e hora de criação da categoria.
  - **UpdatedAt:** Data e hora da última atualização da categoria.
  - **DeletedAt:** Data e hora de exclusão da categoria.

  Exemplo de dados:

  | Id | Description           | IsDeleted | CreatedAt           | UpdatedAt           | DeletedAt           |
  |----|-----------------------|-----------|---------------------|---------------------|---------------------|
  | 1  | Software Issue        | 0         | 2023-11-05 09:15:00 | 2023-11-25 14:40:00 | NULL                |
  | 2  | Equipment Malfunction | 1         | 2023-11-18 10:30:00 | 2023-11-28 12:20:00 | 2023-11-29 08:45:00 |
<br>

**Tabela `Ticket_History`:**

Descrição: Contém as informações dos histórico de ações associadas aos tickets.

Colunas Principais: Id, Ticket_Id, Ticket_Info, Action_Id.


  - **Id (Primary Key):** Identificador único para cada histórico de ticket.
  - **Ticket_Id (Foreign Key):** Referência ao ticket associado.
  - **Ticket_Info:** Informações sobre o ticket.
  - **Action_Id (Foreign Key):** Referência à ação associada.

  Exemplo de dados:

  | Id | Ticket_Id | Ticket_Info               | Action_Id |
  |----|-----------|---------------------------|-----------|
  | 1  | 101       | Resolved software issue   | 201       |
  | 2  | 102       | Updated equipment status  | 202       |
<br>

**Tabela `Ticket_Prio`:**

Descrição: Contém as informações sobre as prioridades associadas ao tickets.

Colunas Principais: Id, Description, Default_DueByDate.

  - **Id (Primary Key):** Identificador único para cada prioridade de ticket.
  - **Description:** Descrição da prioridade do ticket.
  - **Default_DueByDate:** Prazo padrão para a prioridade.
  - **IsDeleted:** Indica se a prioridade foi excluída.
  - **CreatedAt:** Data e hora de criação da prioridade.
  - **UpdatedAt:** Data e hora da última atualização da prioridade.
  - **DeletedAt:** Data e hora de exclusão da prioridade.

  Exemplo de dados:

  | Id | Description | Default_DueByDate | IsDeleted | CreatedAt           | UpdatedAt           | DeletedAt           |
  |----|-------------|-------------------|-----------|---------------------|---------------------|---------------------|
  | 1  | High        | 3 days            | 0         | 2023-11-05 09:30:00 | 2023-11-25 15:10:00 | NULL                |
  | 2  | Medium      | 7 days            | 0         | 2023-11-18 11:45:00 | 2023-11-28 13:30:00 | 2023-11-29 09:20:00 |
<br>

**Tabela `Ticket_Status`:**

 Descrição: Contém as informações sobre os Status do tickets.

 Colunas Principais: Id, Description.

  - **Id (Primary Key):** Identificador único para cada status de ticket.
  - **Description:** Descrição do status do ticket.
  - **IsDeleted:** Indica se o status foi excluído.
  - **CreatedAt:** Data e hora de criação do status.
  - **UpdatedAt:** Data e hora da última atualização do status.
  - **DeletedAt:** Data e hora de exclusão do status.

  Exemplo de dados:

  | Id | Description | IsDeleted | CreatedAt           | UpdatedAt           | DeletedAt           |
  |----|-------------|-----------|---------------------|---------------------|---------------------|
  | 1  | Open        | 0         | 2023-11-05 10:00:00 | 2023-11-25 15:30:00 | NULL                |
  | 2  | In Progress | 0         | 2023-11-18 12:15:00 | 2023-11-28 14:00:00 | 2023-11-29 09:45:00 |
<br>

**Tabela `Tickets`:**

Descrição: Contém as informações sobre os tickets.

Colunas Principais: Id, User_Id, Title, Description, Status_Id, DueByDate, Attachments, Ticket_Category_Id, Ticket_Prio_Id.

  - **Id (Primary Key):** Identificador único para cada ticket.
  - **User_Id (Foreign Key):** Referência ao usuário associado ao ticket.
  - **Title:** Título do ticket.
  - **Description:** Descrição detalhada do ticket.
  - **Status_Id (Foreign Key):** Referência ao status do ticket.
  - **DueByDate:** Prazo para a conclusão do ticket.
  - **IsDeleted:** Indica se o ticket foi excluído.
  - **Attachments:** Anexos relacionados ao ticket.
  - **Ticket_Category_Id (Foreign Key):** Referência à categoria do ticket.
  - **Ticket_Prio_Id (Foreign Key):** Referência à prioridade do ticket.
  - **CreatedAt:** Data e hora de criação do ticket.
  - **UpdatedAt:** Data e hora da última atualização do ticket.
  - **DeletedAt:** Data e hora de exclusão do ticket.

  Exemplo de dados:

  | Id | User_Id | Title            | Description                 | Status_Id | DueByDate           | IsDeleted | Attachments | Ticket_Category_Id | Ticket_Prio_Id | CreatedAt           | UpdatedAt           | DeletedAt           |
  |----|---------|------------------|-----------------------------|-----------|---------------------|-----------|-------------|--------------------|----------------|---------------------|---------------------|---------------------|
  | 101| 1       | Software Problem | Issues with the operating system | 1     | 2023-12-01 14:00:00 | 0         | file1.pdf   | 1                  | 1              | 2023-11-05 10:30:00 | 2023-11-25 15:50:00 | NULL                |
  | 102| 2       | Network Outage   | Loss of internet connection  | 1     | 2023-12-05 10:00:00 | 0         | file2.pdf   | 2                  | 2              | 2023-11-18 12:45:00 | 2023-11-28 14:30:00 | 2023-11-29 10:10:00 |
<br>

**Tabela `Tickets_Technicians`:**

Descrição: Contém as informações sobre a Associação entre tickets e técnicos.

Colunas Principais: Id, Ticket_Id, Technician_Id.

  - **Id (Primary Key):** Identificador único.
  - **Ticket_Id (Foreign Key):** Referência ao ticket associado.
  - **Technician_Id (Foreign Key):** Referência ao técnico associado ao ticket.

  Exemplo de dados:

  | Id | Ticket_Id | Technician_Id |
  |----|-----------|----------------|
  | 501| 101       | 201            |
  | 502| 102       | 202            |
<br>

**Tabela `Trainings`:**

 Descrição: Contém as informações sobre os treinamentos, materiais necessários e o parceiro.

Colunas Principais: Id, Description, Name, Material_Id, Partner_Id.


  - **Id (Primary Key):** Identificador único para cada treinamento.
  - **Description:** Descrição do treinamento.
  - **Name:** Nome do treinamento.
  - **Material_Id (Foreign Key):** Referência ao material associado ao treinamento.
  - **Partner_Id (Foreign Key):** Referência ao parceiro associado ao treinamento.

  Exemplo de dados:

  | Id  | Description             | Name                  | Material_Id | Partner_Id |
  |-----|-------------------------|-----------------------|-------------|------------|
  | 301 | Software Training       | Introduction to OS    | 401         | 601        |
  | 302 | Network Configuration   | Advanced Networking   | 402         | 602        |
<br>

**Tabela `User`:**

Descrição: Contém as informações sobre os usuários.

Colunas Principais: Id, Name, Username, Email, Contact, Password, Role, Status, IsActive, IsStudent, IsDeleted, User_Class_Id, CreatedAt, UpdatedAt, DeletedAt.

  - **Id (Primary Key):** Identificador único para cada usuário.
  - **Name:** Nome do usuário.
  - **Username:** Nome de usuário.
  - **Email:** Endereço de e-mail do usuário.
  - **Contact:** Número de contato do usuário.
  - **Password:** Senha do usuário.
  - **Role:** Função do usuário.
  - **Status:** Status do usuário.
  - **IsActive:** Indica se o usuário está ativo.
  - **IsStudent:** Indica se o usuário é um estudante.
  - **IsDeleted:** Indica se o usuário foi excluído.
  - **User_Class_Id (Foreign Key):** Referência à classe do usuário.
  - **CreatedAt:** Data e hora de criação do usuário.
  - **UpdatedAt:** Data e hora da última atualização do usuário.
  - **DeletedAt:** Data e hora de exclusão do usuário.

  Exemplo de dados:

  | Id | Name           | Username       | Email                 | Contact       | Password      | Role          | Status        | IsActive | IsStudent | IsDeleted | User_Class_Id | CreatedAt           | UpdatedAt           | DeletedAt           |
  |----|----------------|----------------|-----------------------|---------------|---------------|---------------|---------------|----------|-----------|-----------|---------------|---------------------|---------------------|---------------------|
  | 1  | João Silva     | joaosilvacom   | joao@email.com        | +123456789    | hashedpass123 | Administrator | Active        | 1        | 0         | 0         | NULL          | 2023-11-05 09:45:00 | 2023-11-25 16:00:00 | NULL                |
  | 2  | Maria Oliveira | mariamail      | maria@email.com       | +987654321    | hashedpass456 | Technician    | Active        | 1        | 1         | 0         | NULL          | 2023-11-18 13:00:00 | 2023-11-28 15:00:00 | 2023-11-29 10:30:00 |


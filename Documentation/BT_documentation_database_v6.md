
# INDEX

- [INDEX](#index)
  - [**Tabela `Actions`:**](#tabela-actions)
  - [**Tabela `CourseClass`:**](#tabela-courseclass)
  - [**Tabela `Clothing_Delivery`:**](#tabela-clothing_delivery)
  - [**Tabela `Comments`:**](#tabela-comments)
  - [**Tabela `Course`:**](#tabela-course)
  - [**Tabela `Material`:**](#tabela-material)
  - [**Tabela `Material_Clothing_Delivery`:**](#tabela-material_clothing_delivery)
  - [**Tabela `Material_Training`:**](#tabela-material_training)
  - [**Tabela `Notifications`:**](#tabela-notifications)
  - [**Tabela `Notifications_Type`:**](#tabela-notifications_type)
  - [**Tabela `Notifications_Users`:**](#tabela-notifications_users)
  - [**Tabela `Partner_Trainings_Users`:**](#tabela-partner_trainings_users)
  - [**Tabela `Partners`:**](#tabela-partners)
  - [**Tabela `Role_User`:**](#tabela-role_user)
  - [**Tabela `Ticket_Category`:**](#tabela-ticket_category)
  - [**Tabela `Ticket_History`:**](#tabela-ticket_history)
  - [**Tabela `Ticket_Prio`:**](#tabela-ticket_prio)
  - [**Tabela `Ticket_Status`:**](#tabela-ticket_status)
  - [**Tabela `Tickets`:**](#tabela-tickets)
  - [**Tabela `Tickets_Technicians`:**](#tabela-tickets_technicians)
  - [**Tabela `Trainings`:**](#tabela-trainings)
  - [**Tabela `User`:**](#tabela-user)
  - [**Tabela `PartnerContacts`:**](#tabela-partnercontacts)
  - [**Tabela `Email`:**](#tabela-email)


## **Tabela `Actions`:**

<strong> Descrição: </strong> Trigger que guarda as informações sobre os updates num ticket.


<br>
Colunas:

  - **Id (Primary Key):** Id único de cada ação;
  - **Description:** Descrição da ação realizada num ticket, a ser acionada automaticamente e guardada no historico do ticket `(Update / Delete / Create)`;
  - **Technician_Id:** Id do técnico que fez a mudança no ticket `(Update / Delete / Create)`;
  - **Created_at:** Data e hora do update no ticket.

  Exemplo de dados:

  | Id | Description        | Technician_Id  | Created_at           |
  |----|--------------------|----------------|----------------------|
  | 1  | Update             | 001            | 2023-11-24 14:30:00  |
  | 2  | Delete             | 002            | 2023-11-24 15:45:00  |
  | 3  | Create             | 002            | 2023-11-24 15:45:00  |


<br>

## **Tabela `CourseClass`:**

<strong> Descrição </strong> : Tabela de Turmas.

<strong> Colunas: </strong>

  - **Id (Primary Key):** Id da turma.
  - **Description:** Descrição da turma.
  - **Course_Id:** Id do curso associado à turma.
  - **IsDeleted:** Indica se a turma foi apagada.
  - **Created_at:** Data e hora da criação da turma.
  - **Updated_at:** Data e hora da última atualização.
  - **Deleted_at:** Data e hora da exclusão.

  Exemplo de dados:

  | Id | Description  | Course_Id | IsDeleted | Created_at          | Updated_at           | Deleted_at           |
  |----|--------------|-----------|-----------|---------------------|---------------------|----------------------|
  | 1  | TPSIP        | 001       | 0         | 2023-11-23 10:15:00 | 2023-11-24 10:15:00 | NULL                 |
  | 2  | GRSIP        | 002       | 1         | 2023-11-23 11:30:00 | 2023-11-24 10:15:00 | 2023-11-24 11:45:00 |


<br>

## **Tabela `Clothing_Delivery`:**

<strong> Descrição: </strong> Contém as informações sobre as entregas de fardamento.

<strong> Colunas: </strong>

  - **Id (Primary Key):** Id para cada entrega de fardamento;
  - **User_Id:** Id do user que recebe o fardamento;
  - **Delivered:** Indica se a entrega foi realizada (1 para sim, 0 para não);
  - **Additional_Notes:** Notas adicionais (exemplo: se for necessário mais fardamento).
  - **IsDeleted:** Indica se o registo foi excluído (1 para sim, 0 para não).
  - **Delivered_at:** Data e hora da entrega;
  - **Updated_at:** Data e hora da última atualização;
  - **Deleted_at:** Data e hora da exclusão;

  Exemplo de dados:

  | Id | User_Id | Delivered | Additional_Notes       | IsDeleted | Delivered_at         | Updated_at           | Deleted_at           |
  |----|---------|-----------|-------------|---------|----------------------|----------------------|-------------------------|
  | 1  | 001     | 1         | Este aluno precisou de mais uma bata | 0 | 2023-11-24 09:30:00  | 2023-11-24 10:15:00 | NULL                 |
  | 2  | 002     | 0         | NULL | 0 | NULL                 | 2023-11-24 11:45:00 | NULL                 |


<br>

## **Tabela `Comments`:**

   <strong> Descrição: </strong> Contém as informações sobre os comentários.
   
   <strong>Colunas:</strong>


  - **Id (Primary Key):** Id do comentário.
  - **Description:** Conteúdo do comentário.
  - **User_Id:** Id do User que fez o comentário.
  - **Ticket_Id:** Id do ticket associado ao comentário.
  - **IsPublic:** Indica se o comentário é público (1 para sim, 0 para não).
  - **IsDeleted:** Indica se o comentário foi apagado.
  - **Created_at:** Data e hora de criação do comentário.
  - **Updated_at:** Data e hora da última atualização.
  - **Deleted_at:** Data e hora da exclusão.

  Exemplo de dados:

  | Id | Description             | User_Id | Ticket_Id | IsPublic | IsDeleted | Created_at           | Updated_at           | Deleted_at           |
  |----|-------------------------|---------|-----------|----------|-----------|-----------|----------------------|----------------------|
  | 1  | Tenho uma cadeira partida na sala 1.20   | 001     | 201       | 1  | 0      | 2023-11-24 08:45:00 | 2023-11-24 09:30:00 | NULL                 |
  | 2  | Issue resolved.         | 002     | 202       | 0 | 0       | 2023-11-24 10:00:00 | 2023-11-24 10:45:00 | NULL                 |


<br>

## **Tabela `Course`:**

Descrição: Contém os detalhes dos cursos.

<strong>Colunas:</strong>

  - **Id (Primary Key):** Id do curso.
  - **Description:** Nome ou descrição do curso.
  - **Code:** Código do curso.
  - **IsDeleted:** Indica se o curso foi excluído (1 para sim, 0 para não).
  - **Created_at:** Data e hora de criação do curso.
  - **Updated_at:** Data e hora da última atualização.
  - **Deleted_at:** Data e hora da exclusão.

  Exemplo de dados:

  | Id | Description               | Code   | IsDeleted | Created_at           | Updated_at           | Deleted_at           |
  |----|---------------------------|--------|-----------|----------------------|----------------------|----------------------|
  | 1  | Técnico Especialista de Tecnologias e Programação de Sistemas de Informática| TPSIP| 0         | 2023-11-24 09:00:00 | 2023-11-24 09:30:00 | NULL                 |
  | 2  | Cyber Security     | CS | 0         | 2023-11-24 10:15:00 | 2023-11-24 10:45:00 | NULL                 |


<br>

## **Tabela `Material`:**

Descrição: Contém as informações sobre os materiais disponíveis.

<strong>Colunas: </strong>

  - **Id (Primary Key):** Id do material.
  - **Name:** Nome do material.
  - **Description:** Descrição do material.
  - **IsInternal:** Indica se o material é interno (1 para sim, 0 para não).
  - **Quantity:** Quantidade disponível do material em stock.
  - **Aquisition_Date:** Data de aquisição do material.
  - **Supplier:** Fornecedor do material.
  - **IsClothing:** Indica se o material é do tipo roupa (1 para sim, 0 para não).
  - **Gender:** Género do material (apenas para materiais do tipo roupa; ex: bata de homem).
  - **Size:** Tamanho do material (apenas para materiais do tipo roupa).
  - **Role:** Indica se é para formador, formando ou não-docente (apenas para materiais do tipo roupa).
  - **IsDeleted:** Indica se o material foi excluído (1 para sim, 0 para não).
  - **Created_at:** Data e hora de criação do material.
  - **Updated_at:** Data e hora da última atualização.
  - **Deleted_at:** Data e hora da exclusão.

  Exemplo de dados:

  | Id | Name          | Description               | IsInternal | Quantity | Aquisition_Date | Supplier       | IsClothing | Gender | Size | Role      | IsDeleted | Created_at           | Updated_at           | Deleted_at           |
  |----|---------------|---------------------------|------------|----------|-----------------|----------------|------------------|--------|------|-----------|-----------|----------------------|----------------------|----------------------|
  | 1  | Bata        | Bata de Formador   | 1          | 10       | 2023-11-24      | Adidas   | 1                | Male   | M | Formador      | 0         | 2023-11-24 09:45:00 | 2023-11-24 10:15:00 | NULL                 |
  | 2  | Bota de Biqueira de aço| EPI para formandos        | 1          | 50       | 2023-11-24      | SafetyEquip    | 1                | Male   | 40 | Formando      | 0         | 2023-11-24 11:00:00 | 2023-11-24 11:30:00 | NULL                 |


<br>

## **Tabela `Material_Clothing_Delivery`:**

Descrição: Contém as informações das entrega de roupas.

<strong>Colunas: </strong>

  - **Id (Primary Key):** Id da entrega de material.
  - **Clothing_Delivery_Id (Foreign Key):** Referência à tabela que indica se o fardamento já foi entregue.
  - **Material_Id (Foreign Key):** Referência ao material a ser entregue.

  Exemplo de dados:

  | Id | Clothing_Delivery_Id | Material_Id |
  |----|----------------------|-------------|
  | 1  | 007                  | 010         |
  | 2  | 012                  | 023         |


<br>

## **Tabela `Material_Training`:**

 Descrição: Contém as informações sobre os materiais para formações externas e as suas quantidades.

Colunas:

  - **Id (Primary Key):** Id da tabela.
  - **Material_Id (Foreign Key):** Referência ao material associado à formação.
  - **Training_Id (Foreign Key):** Referência à formação.
  - **Quantity:** Quantidade de um material especifico utilizado na formação.

  Exemplo de dados:

  | Id | Material_Id | Training_Id | Quantity |
  |----|--------------|--------------|----------|
  | 1  | 1            | 1            | 20       |
  | 2  | 2            | 2            | 30       |


<br>

## **Tabela `Notifications`:**

Descrição: Contém as informações sobre as notificações.

Colunas:

  - **Id (Primary Key):** Id da notificação.
  - **Description:** Conteudo da notificação.
  - **Notification_Type_Id (Foreign Key):** Referência à tabela que contém os tipos de notificações.
  - **Object_Id:** Id do objeto (Ticket / Material / Training / Comment).
  - **IsDeleted:** Indica se a notificação foi excluída.
  - **Created_at:** Data e hora de criação da notificação.
  - **Deleted_at:** Data e hora de exclusão da notificação.

  Exemplo de dados:

  | Id | Description   | Notification_Type_Id | Object_Id | IsDeleted | Created_at | Deleted_at |
  |----|---------------|----------------------|-----------|-----------|------------|------------|
  | 1  | Nova mensagem | 101                  | 201       | 0         | 2023-11-24 13:09:29  | NULL                 |
  | 2  | Atualização         | 102      | 202        | 1          | 2023-11-23 15:30:45  | 2023-11-23 16:00:12  |


<br>

## **Tabela `Notifications_Type`:**

Descrição: Contém as informações sobre os tipos de notificações disponíveis.

Colunas:

  - **Id (Primary Key):** Id do tipo de notificação.
  - **Description:** Descrição do tipo de notificação.
  - **Code:** Código do tipo de notificação, uma constante (COMMENT/TICKET/TRAINING/MATERIAL).

  Exemplo de dados:

  | Id | Description          | Code  |
  |----|----------------------|-------|
  | 101| Comentário       | COMMENT   |
  | 102| Ticket!           | TICKET   |


<br>

## **Tabela `Notifications_Users`:**

Descrição: Associa as notificações aos users que as vão receber.

Colunas:

  - **Id (Primary Key):** Id da tabela.
  - **User_Id (Foreign Key):** Referência ao user que vai receber a notificação.
  - **Notification_Id (Foreign Key):** Id da notificação.
  - **isRead:** Indica se a notificação foi lida pelo user.

  Exemplo de dados:

  | Id | User_Id | Notification_Id | isRead |
  |----|---------|-----------------|--------|
  | 1  | 001     | 1               | 0      |
  | 2  | 002     | 2               | 1      |

<br>

## **Tabela `Partner_Trainings_Users`:**

Descrição: Tabela que guarda as formações externas, parceiros e tecnico responsavel.
     
Colunas:

  - **Id (Primary Key):** Id da tabela.
  - **User_Id (Foreign Key):** Técnico alocado à organização da formação.
  - **Training_Id (Foreign Key):** Id da formação associada.
  - **Partner_Id (Foreign Key):** Id do parceiro que vai receber a formação.
  - **Start_Date:** Data de início da formação.
  - **End_Date:** Data de término da formação.
  - **IsDeleted:** Indica se a formação foi excluída.
  - **Created_at:** Data e hora de criação da formação.
  - **Updated_at:** Data e hora da última atualização da formação.
  - **Deleted_at:** Data e hora de exclusão da formação.

  Exemplo de dados:

  | Id | Partner_Id | Training_Id | User_Id | Start_Date          | End_Date            | IsDeleted | Created_at           | Updated_at           | Deleted_at           |
  |----|------------|--------------|---------|---------------------|---------|------------|---------------------|---------------------|---------------------|
  | 1  | 401        | 501          | 601     | 2023-11-01 08:00:00 | 2023-11-30 17:00:00 | 0                | 2023-11-01 10:30:15 | 2023-11-28 14:20:45 | NULL                |
  | 2  | 402        | 502          | 602     | 2023-11-15 09:30:00 | 2023-11-30 15:45:00 | 1                | 2023-11-15 11:40:22 | 2023-11-29 12:15:30 | 2023-11-30 09:10:05 |

<br>

## **Tabela `Partners`:**

 Descrição: Contém as informações dos parceiros.

Colunas Principais: Id, Name, Description, Address, Contact.

  - **Id (Primary Key):** Identificador único para cada parceiro.
  - **Name:** Nome do parceiro.
  - **Description:** Descrição do parceiro.
  - **Address:** Endereço do parceiro.
  - **IsDeleted:** Indica se o parceiro foi excluído.
  - **Created_at:** Data e hora de criação do parceiro.
  - **Updated_at:** Data e hora da última atualização do parceiro.
  - **Deleted_at:** Data e hora de exclusão do parceiro.

  Exemplo de dados:

  | Id | Name             | Description            | Address                  | IsDeleted | Created_at           | Updated_at           | Deleted_at           |
  |----|------------------|------------------------|-----------------------------------------------|-----------|---------------------|---------------------|---------------------|
  | 401 | Partner A        | Training partner       | Rua Partner, 123         |  0         | 2023-11-01 10:00:00 | 2023-11-25 15:30:00 | NULL                |
  | 402 | Partner B        | Fitness equipment      | Av. Commercial, 567      | 1         | 2023-11-15 11:20:00 | 2023-11-29 14:45:00 | 2023-11-30 10:05:00 |

<br>


## **Tabela `Role_User`:**

Descrição: Contém as ligações dos users às roles.

Colunas:

  - **Id (Primary Key):** Id da role.
  - **Role_Id (Foreign Key):** Referência à role.
  - **User_Id (Foreign Key):** Id do user.

  Exemplo de dados:

  | Id | Role_Id | User_Id |
  |----|---------|---------|
  | 1  | 001     | 003     |
  | 2  | 002     | 014     |

<br>

**Tabela `Roles`:**

Descrição: Guarda as roles disponiveis.

Colunas:

  - **Id (Primary Key):** Id da role.
  - **Name:** Nome da role.
  - **Description:** Descrição da role.

  Exemplo de dados:

  | Id | Name           | Description                  |
  |----|----------------|------------------------------|
  | 001| ADMIN  | Administrador do sistema    |
  | 002| TRAINER        | Formador |

<br>

## **Tabela `Ticket_Category`:**

 Descrição: Contém as informações sobre as Categorias de tickets.

Colunas:

  - **Id (Primary Key):** Id da categoria do ticket.
  - **Description:** Descrição da categoria de ticket.
  - **IsDeleted:** Indica se a categoria foi excluída.
  - **Created_at:** Data e hora de criação da categoria.
  - **Updated_at:** Data e hora da última atualização da categoria.
  - **Deleted_at:** Data e hora de exclusão da categoria.

  Exemplo de dados:

  | Id | Description           | IsDeleted | Created_at           | Updated_at           | Deleted_at           |
  |----|-----------------------|-----------|---------------------|---------------------|---------------------|
  | 1  | Software        | 0         | 2023-11-05 09:15:00 | 2023-11-25 14:40:00 | NULL                |
  | 2  | Equipment | 1         | 2023-11-18 10:30:00 | 2023-11-28 12:20:00 | 2023-11-29 08:45:00 |

<br>

## **Tabela `Ticket_History`:**

Descrição: Histórico do ticket.

Colunas:

  - **Id (Primary Key):** Id da mudança no ticket.
  - **Ticket_Id (Foreign Key):** Referência ao ticket que foi feita alteração.
  - **Ticket_Info:** Guarda todas as informações da alteração que foi feita ao ticket numa string concatenada.
  - **Action_Id (Foreign Key):** Id da ação tomada.

  Exemplo de dados:

  | Id | Ticket_Id | Ticket_Info               | Action_Id |
  |----|-----------|---------------------------|-----------|
  | 1  | 001       | 101,1,Software Problem,Issues with the operating system,1,2023-12-01 14:00:00,0,file1.pdf,1,1,2023-11-05 10:30:00,2023-11-25 15:50:00,NULL   | 001       |
  | 2  | 001       | 101,1,Software Problem,Issues with the operating system,1,2023-12-01 14:00:00,0,file1.pdf,1,1,2023-11-05 10:30:00,2023-11-25 15:50:00,NULL  | 002       |

<br>

## **Tabela `Ticket_Prio`:**

Descrição: Prioridade dos tickets.

Colunas:

  - **Id (Primary Key):** Id da prioridade do ticket.
  - **Description:** Descrição da prioridade do ticket.
  - **Default_DueByDate:** Data limite padrão para resolução do ticket com esta prioridade selecionada.
  - **IsDeleted:** Indica se a prioridade foi excluída.
  - **Created_at:** Data e hora de criação da prioridade.
  - **Updated_at:** Data e hora da última atualização da prioridade.
  - **Deleted_at:** Data e hora de exclusão da prioridade.

  Exemplo de dados:

  | Id | Description | Default_DueByDate | IsDeleted | Created_at           | Updated_at           | Deleted_at           |
  |----|-------------|-------------------|-----------|---------------------|---------------------|---------------------|
  | 1  | High        | 2023-11-05 09:30:00            | 0         | 2023-11-05 09:30:00 | 2023-11-25 15:10:00 | NULL                |
  | 2  | Medium      | 2023-11-05 09:30:00            | 1         | 2023-11-18 11:45:00 | 2023-11-28 13:30:00 | 2023-11-29 09:20:00 |

<br>

## **Tabela `Ticket_Status`:**

 Descrição: Status do ticket.

 Colunas:

  - **Id (Primary Key):** Id do status do ticket.
  - **Description:** Descrição do status do ticket.
  - **IsDeleted:** Indica se o status foi excluído.
  - **Created_at:** Data e hora de criação do status.
  - **Updated_at:** Data e hora da última atualização do status.
  - **Deleted_at:** Data e hora de exclusão do status.

  Exemplo de dados:

  | Id | Description | IsDeleted | Created_at          | Updated_at          | Deleted_at          |
  |----|-------------|-----------|---------------------|---------------------|---------------------|
  | 1  | Open        | 0         | 2023-11-05 10:00:00 | 2023-11-25 15:30:00 | NULL                |
  | 2  | On Hold     | 1         | 2023-11-18 12:15:00 | 2023-11-28 14:00:00 | 2023-11-29 09:45:00 |
  | 3  | Resolved    | 1         | 2023-11-18 12:15:00 | 2023-11-28 14:00:00 | 2023-11-29 09:45:00 |

<br>

## **Tabela `Tickets`:**

Descrição: Contém as informações sobre os tickets.

Colunas:

  - **Id (Primary Key):** Id do ticket.
  - **Requester_Id (Foreign Key):** User que criou o ticket.
  - **Title:** Breve descrição do problema.
  - **Description:** Descrição detalhada do problema.
  - **DueByDate:** Prazo para a conclusão do ticket.
  - **Attachments:** Anexos relacionados ao ticket.
  - **Ticket_Status_Id (Foreign Key):** Referência ao status do ticket.
  - **Ticket_Category_Id (Foreign Key):** Referência à categoria do ticket.
  - **Ticket_Prio_Id (Foreign Key):** Referência à prioridade do ticket.
  - **IsDeleted:** Indica se o ticket foi excluído.
  - **Created_at:** Data e hora de criação do ticket.
  - **Updated_at:** Data e hora da última atualização do ticket.
  - **Deleted_at:** Data e hora de exclusão do ticket.

  Exemplo de dados:

  | Id | Requester_Id | Title            | Description                 | DueByDate           | Attachments | Ticket_Status_Id | Ticket_Category_Id | Ticket_Prio_Id | IsDeleted | Created_at           | Updated_at           | Deleted_at           |
  |----|---------|------------------|-----------------------------|-----------|---------------------|-----------|-------------|--------------------|----------------|---------------------|---------------------|---------------------|
  | 101| 1       | Lampada Fundida | Preciso de uma lampada para a sala 1.20 | 2023-12-01 14:00:00 | file1.pdf   | 1     | 1                  | 1              | 0         | 2023-11-05 10:30:00 | 2023-11-25 15:50:00 | NULL                |
  | 102| 2       | Cadeira Partida   | Cadeira partida na sala 1.17  | 2023-12-05 10:00:00 | file2.pdf   | 1     | 2                  | 2              | 1         | 2023-11-18 12:45:00 | 2023-11-28 14:30:00 | 2023-11-29 10:10:00 |

<br>

## **Tabela `Tickets_Technicians`:**

Descrição: Tabela que guarda os técnicos que estão associados ao ticket.

Colunas:

  - **Id (Primary Key):** Id da tabela.
  - **Ticket_Id (Foreign Key):** Referência ao ticket associado.
  - **Technician_Id (Foreign Key):** Referência ao técnico associado ao ticket.

  Exemplo de dados:

  | Id | Ticket_Id | Technician_Id |
  |----|-----------|----------------|
  | 501| 101       | 002            |
  | 502| 102       | 005            |

<br>

## **Tabela `Trainings`:**

 Descrição: Contém as informações sobre as formações.

Colunas:

  - **Id (Primary Key):** Id da formação.
  - **Name:** Nome da formação.
  - **Description:** Descrição da formação.
  - **Category:** Categoria da formação.
  - **IsDeleted:** Boolean para indicar se a formação foi excluída.
  - **Created_at:** Data e hora de criação da formação.
  - **Updated_at:** Data e hora da última atualização da formação.
  - **Deleted_at:** Data e hora de exclusão da formação.

  Exemplo de dados:

  | Id  | Name                  | Description             | Category | isDeleted | Created_at           | Updated_at           | Deleted_at           |
  |-----|------------|----------------------------|---------|-----------|----|-----------|---------------------|
  | 301 | Cybersecurity    | Overview on security when browsing online       | Security        | 0 | 2023-11-05 10:30:00 | 2023-11-25 15:50:00 | NULL                |
  | 302 | Networking   | Network Configuration   | Networking        | 0 | 2023-11-18 12:45:00 | 2023-11-28 14:30:00 | NULL |

<br>

## **Tabela `User`:**

Descrição: Contém as informações sobre os users.

Colunas 

  - **Id (Primary Key):** Id do user.
  - **Name:** Nome do user
  - **Username:** Código do user que pode ser usado como login (ex: T0123123)
  - **Email:** Endereço de e-mail do user.
  - **Contact:** Contacto do user.
  - **Password:** Password do user.
  - **Role:** Função do user no sistema.
  - **IsActive:** Boolean para se o user está ativo.
  - **IsStudent:** Boolean para se o user é aluno.
  - **Class_Id (Foreign Key):** Id da turma do user (nullable, apenas preenchido caso seja IsStudent seja true)
  - **IsDeleted:** Boolean para indicar se o usuário foi excluído.
  - **Created_at:** Data e hora de criação do user.
  - **Updated_at:** Data e hora da última atualização do user.
  - **Deleted_at:** Data e hora de exclusão do user.

  Exemplo de dados:

  | Id | Name           | Username       | Email                 | Contact       | Password      | Role          | IsActive | IsStudent | Class_Id | IsDeleted | Created_at           | Updated_at           | Deleted_at           |
  |----|----------------|----------------|-----------------------|---------------|---------------|---------------|---------------|----------|-----------|---------------|---------------------|---------------------|---------------------|
  | 1  | João Silva     | T0000001   | joao@email.com        | +123456789    | hashedpass123 | Admin |  1        | 0         | NULL          | 0         | 2023-11-05 09:45:00 | 2023-11-25 16:00:00 | NULL                |
  | 2  | Maria Oliveira | T0123452      | maria@email.com       | +987654321    | hashedpass456 | Student    | 1        | 1         | TPSI 06.22          | 0         | 2023-11-18 13:00:00 | 2023-11-28 15:00:00 | NULL |

<br>

## **Tabela `PartnerContacts`:**

Descrição: Contém as informações sobre os contactos de cada Partner.

  Colunas 

  - **Id (Primary Key):** Id do Contact.
  - **Contact:** Contacto do Partner.
  - **Partner_Id:** Id do Partner.
  - **IsDeleted:** Boolean para indicar se o contacto foi excluído.
  - **Created_at:** Data e hora de criação do user.
  - **Updated_at:** Data e hora da última atualização do user.
  - **Deleted_at:** Data e hora de exclusão do user.

  Exemplo de dados:

  | Id | Contact   | Partner_Id | IsDeleted | Created_at          | Updated_at          | Deleted_at          |
  |----|-----------|------------|-----------|---------------------|---------------------|------|
  | 1  | 918283432 |      1     | 0         | 2023-11-05 09:45:00 | 2023-11-25 16:00:00 | NULL |
  | 2  | 252839344 |      1     | 0         | 2023-11-05 09:47:00 | 2023-11-25 16:00:00 | NULL |
  | 3  | 918233432 |      2     | 0         | 2023-11-05 09:50:00 | 2023-11-25 17:00:00 | NULL |
  | 4  | 252812344 |      2     | 0         | 2023-11-05 09:42:00 | 2023-11-25 17:00:00 | NULL |
  
  
<br>

## **Tabela `Email`:**

Descrição: Contém as informações sobre os emails a enviar quando houver alterações de tickets.

  Colunas 

  - **Id (Primary Key):** Id do Email.
  - **User_Id (Foreign Key):** Id do utilizador que envia o email.
  - **Recipient_Email:** Email do destinatário (a ser passado pelo campo Requester_Id da tabela Tickets que por sua vez é passado pelo campo Ticket_Id da tabela Ticket_History).
  - **Subject:** Assunto do email.
  - **Message:** Corpo do email.
  - **Ticket_History_Id:** Referência ao id do histórico do ticket.
  - **Sent_at:** Data e hora do envio do email.


Exemplo de dados:

  | Id | User_Id   | Recipient_Email   | Subject             | Message       | Ticket_History_Id |Sent_at             |
  |----|-----------|-------------------|---------------------|---------------|---|-----------------|
  | 1  |     1     | joao@email.com    | Ticket 002 updated  | [PLACEHOLDER] | 4 | 2023-11-25 16:00:00 |
  | 2  |     5     | maria@email.com   | Ticket 011 deleted  | [PLACEHOLDER] | 7 | 2023-11-25 16:00:00 |
  | 3  |     12    | johndoe@email.com | Ticket 005 closed   | [PLACEHOLDER] | 1 | 2023-11-25 17:00:00 |
  | 4  |     7     | janedoe@gmail.com | Ticket 007 resolved | [PLACEHOLDER] | 3 | 2023-11-25 17:00:00 |
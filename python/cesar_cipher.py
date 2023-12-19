def caesar_cipher(text, shift, language):
    if language == 'английский':
        alphabet = 'abcdefghijklmnopqrstuvwxyz'
        alphabet_size = len(alphabet)
    elif language == 'русский':
        alphabet = 'абвгдежзийклмнопрстуфхцчшщъыьэюя'
        alphabet_size = len(alphabet)
    else:
        print('Неизвестный язык')
        return

    encrypted_text = ''
    for char in text:
        if char.lower() in alphabet:
            if char.isupper():
                index = (alphabet.index(char.lower()) + shift) % alphabet_size
                encrypted_text += alphabet[index].upper()
            else:
                index = (alphabet.index(char) + shift) % alphabet_size
                encrypted_text += alphabet[index]
        else:
            encrypted_text += char

    return encrypted_text


def open_files_and_encrypt():
    input_file = input("Введите путь до изначального файла с текстом: ")
    output_file = input("Введите путь до файла, куда сохранить зашифрованный текст: ")
    shift = int(input("Введите требуемый сдвиг: "))
    language = input("Выберите язык текста (английский или русский): ")

    with open(input_file, 'r', encoding='utf-8') as file:
        text = file.read()

    encrypted_text = caesar_cipher(text, shift, language)

    with open(output_file, 'w', encoding='utf-8') as file:
        file.write(encrypted_text)


open_files_and_encrypt()

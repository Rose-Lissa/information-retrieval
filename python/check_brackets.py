def check_brackets(sequence):
    stack = []
    pairs = {'(': ')', '[': ']', '{': '}'}

    for char in sequence:
        if char in pairs.keys():
            stack.append(char)
        elif char in pairs.values():
            if not stack or pairs[stack.pop()] != char:
                return False

    return len(stack) == 0  # Если стек пустой, значит все скобки были правильно закрыты


sequence = input("Введите скобочную последовательность: ")
if check_brackets(sequence):
    print("Правильная последовательность")
else:
    print("Неправильная последовательность")
